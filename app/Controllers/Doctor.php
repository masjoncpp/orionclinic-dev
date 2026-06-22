<?php namespace App\Controllers;

use App\Models\DoctorModel;
use App\Models\AppointmentModel;
use App\Models\PatientModel;

class Doctor extends BaseController
{
    protected $doctorModel;
    protected $appointmentModel;

    public function __construct()
    {
        $this->doctorModel = new DoctorModel();
        $this->appointmentModel = new AppointmentModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $doctor = $this->doctorModel->where('user_id', $userId)->first();

        if (!$doctor) {
            session()->destroy();
            return redirect()->to('/auth/login')->with('error', 'Profil dokter tidak ditemukan. Silakan hubungi admin.');
        }

        // Stats
        $today = date('Y-m-d');
        $stats = [
            'total_today' => $this->appointmentModel->where('doctor_id', $doctor['id'])
                                                    ->where('appointment_date', $today)
                                                    ->countAllResults(),
            'waiting'     => $this->appointmentModel->where('doctor_id', $doctor['id'])
                                                    ->where('appointment_date', $today)
                                                    ->where('status', 'confirmed')
                                                    ->countAllResults(),
            'completed'   => $this->appointmentModel->where('doctor_id', $doctor['id'])
                                                    ->where('appointment_date', $today)
                                                    ->where('status', 'completed')
                                                    ->countAllResults(),
        ];

        // Upcoming Patients (Today's confirmed appointments)
        $upcoming = $this->appointmentModel
            ->select('appointments.*, patients.id as patient_id, users.name as patient_name')
            ->join('patients', 'patients.id = appointments.patient_id')
            ->join('users', 'users.id = patients.user_id')
            ->where('appointments.doctor_id', $doctor['id'])
            ->where('appointments.appointment_date', $today)
            ->where('appointments.status', 'confirmed')
            ->orderBy('appointments.time_slot', 'ASC')
            ->findAll();

        return view('doctor/dashboard', [
            'role' => 'doctor',
            'title' => 'Dashboard Dokter',
            'doctor' => $doctor,
            'stats' => $stats,
            'upcoming' => $upcoming
        ]);
    }
    public function consultation()
    {
        $userId = session()->get('user_id');
        $doctor = $this->doctorModel->where('user_id', $userId)->first();

        if (!$doctor) {
            session()->destroy();
            return redirect()->to('/auth/login')->with('error', 'Profil dokter tidak ditemukan. Silakan hubungi admin.');
        }

        $today = date('Y-m-d');
        
        $data = [
            'role' => 'doctor',
            'title' => 'Jadwal Dokter',
            'pending_appointments' => $this->appointmentModel
                ->select('appointments.*, users.name as patient_name')
                ->join('patients', 'patients.id = appointments.patient_id')
                ->join('users', 'users.id = patients.user_id')
                ->where('appointments.doctor_id', $doctor['id'])
                ->where('appointments.status', 'pending')
                ->orderBy('appointment_date', 'ASC')
                ->orderBy('time_slot', 'ASC')
                ->findAll(),
            'today_appointments' => $this->appointmentModel
                ->select('appointments.*, users.name as patient_name')
                ->join('patients', 'patients.id = appointments.patient_id')
                ->join('users', 'users.id = patients.user_id')
                ->where('appointments.doctor_id', $doctor['id'])
                ->where('appointments.appointment_date', $today)
                ->orderBy('time_slot', 'ASC')
                ->findAll(),
            'upcoming_appointments' => $this->appointmentModel
                ->select('appointments.*, users.name as patient_name')
                ->join('patients', 'patients.id = appointments.patient_id')
                ->join('users', 'users.id = patients.user_id')
                ->where('appointments.doctor_id', $doctor['id'])
                ->where('appointments.appointment_date >', $today)
                ->orderBy('appointment_date', 'ASC')
                ->orderBy('time_slot', 'ASC')
                ->findAll(),
            'completed_appointments' => $this->appointmentModel
                ->select('appointments.*, users.name as patient_name')
                ->join('patients', 'patients.id = appointments.patient_id')
                ->join('users', 'users.id = patients.user_id')
                ->where('appointments.doctor_id', $doctor['id'])
                ->where('appointments.status', 'completed')
                ->orderBy('appointment_date', 'DESC')
                ->findAll(),
        ];

        return view('doctor/consultation', $data);
    }

    public function acceptAppointment()
    {
        $appointmentId = $this->request->getPost('appointment_id');
        if (!$appointmentId) return redirect()->back()->with('error', 'ID tidak valid');

        // Update appointment to confirmed
        $this->appointmentModel->update($appointmentId, ['status' => 'confirmed']);

        // Create consultation record for the chat
        $consultationModel = new \App\Models\ConsultationModel();
        $consultationModel->insert([
            'appointment_id' => $appointmentId,
            'diagnosis' => '',
            'doctor_notes' => '',
            'status' => 'active'
        ]);

        return redirect()->to('doctor/consultation')->with('success', 'Jadwal konsultasi berhasil diterima.');
    }

    public function rejectAppointment()
    {
        $appointmentId = $this->request->getPost('appointment_id');
        if (!$appointmentId) return redirect()->back()->with('error', 'ID tidak valid');

        $this->appointmentModel->update($appointmentId, ['status' => 'cancelled']);

        return redirect()->to('doctor/consultation')->with('success', 'Jadwal konsultasi telah ditolak.');
    }
    public function patients()
    {
        $userId = session()->get('user_id');
        $doctor = $this->doctorModel->where('user_id', $userId)->first();

        if (!$doctor) {
            session()->destroy();
            return redirect()->to('/auth/login')->with('error', 'Profil dokter tidak ditemukan. Silakan hubungi admin.');
        }

        // Fetch unique patients who have appointments with this doctor
        $patients = $this->appointmentModel
            ->select('patients.*, users.name, users.email, users.phone')
            ->join('patients', 'patients.id = appointments.patient_id')
            ->join('users', 'users.id = patients.user_id')
            ->where('appointments.doctor_id', $doctor['id'])
            ->groupBy('patients.id')
            ->findAll();

        return view('doctor/patients', [
            'role' => 'doctor',
            'title' => 'Data Pasien',
            'patients' => $patients
        ]);
    }

    public function patientHistory()
    {
        $patientId = $this->request->getGet('id');
        $userId = session()->get('user_id');
        $doctor = $this->doctorModel->where('user_id', $userId)->first();
        
        if (!$doctor || !$patientId) {
            return redirect()->to('doctor/patients')->with('error', 'Data tidak ditemukan.');
        }

        // Fetch patient basic info
        $patient = $this->appointmentModel
            ->select('patients.*, users.name, users.email, users.phone')
            ->join('patients', 'patients.id = appointments.patient_id')
            ->join('users', 'users.id = patients.user_id')
            ->where('patients.id', $patientId)
            ->where('appointments.doctor_id', $doctor['id'])
            ->first();

        if (!$patient) {
            return redirect()->to('doctor/patients')->with('error', 'Pasien tidak ditemukan atau belum pernah konsultasi dengan Anda.');
        }

        // Fetch completed appointments for this patient with this doctor
        $history = $this->appointmentModel
            ->select('appointments.*, consultations.diagnosis, consultations.status as consultation_status')
            ->join('consultations', 'consultations.appointment_id = appointments.id', 'left')
            ->where('appointments.patient_id', $patient['id'])
            ->where('appointments.doctor_id', $doctor['id'])
            ->where('appointments.status', 'completed')
            ->orderBy('appointment_date', 'DESC')
            ->findAll();

        return view('doctor/patient_history', [
            'role' => 'doctor',
            'title' => 'Riwayat Medis Pasien',
            'hide_sidebar' => true,
            'patient' => $patient,
            'history' => $history
        ]);
    }

    public function historyDetail()
    {
        $appointmentId = $this->request->getGet('id');
        $userId = session()->get('user_id');
        
        $doctor = $this->doctorModel->where('user_id', $userId)->first();
        if (!$doctor || !$appointmentId) {
            return redirect()->to('doctor/consultation')->with('error', 'Data tidak ditemukan.');
        }

        $appointment = $this->appointmentModel
            ->select('appointments.*, users.name as patient_name, patients.gender')
            ->join('patients', 'patients.id = appointments.patient_id')
            ->join('users', 'users.id = patients.user_id')
            ->where('appointments.id', $appointmentId)
            ->where('appointments.doctor_id', $doctor['id'])
            ->first();

        if (!$appointment) {
            return redirect()->to('doctor/consultation')->with('error', 'Riwayat tidak ditemukan.');
        }

        $consultationModel = new \App\Models\ConsultationModel();
        $consultation = $consultationModel->where('appointment_id', $appointmentId)->first();

        $prescription = null;
        $prescriptionItems = [];
        if ($consultation) {
            $prescriptionModel = new \App\Models\PrescriptionModel();
            $prescription = $prescriptionModel->where('consultation_id', $consultation['id'])->first();
            
            if ($prescription) {
                $itemModel = new \App\Models\PrescriptionItemModel();
                $prescriptionItems = $itemModel->where('prescription_id', $prescription['id'])->findAll();
            }
        }

        return view('doctor/history_detail', [
            'role'              => 'doctor',
            'title'             => 'Detail Riwayat Pasien',
            'hide_sidebar'      => true,
            'appointment'       => $appointment,
            'consultation'      => $consultation,
            'prescription'      => $prescription,
            'prescriptionItems' => $prescriptionItems
        ]);
    }
    public function profile()      { return view('doctor/profile',      ['role' => 'doctor', 'title' => 'Profil Dokter']); }
    
    public function schedules()
    {
        $userId = session()->get('user_id');
        $doctor = $this->doctorModel->where('user_id', $userId)->first();
        
        if (!$doctor) {
            return redirect()->to('/auth/login')->with('error', 'Profil dokter tidak ditemukan.');
        }

        $scheduleModel = new \App\Models\DoctorScheduleModel();
        $schedules = $scheduleModel->where('doctor_id', $doctor['id'])->findAll();

        // Organize schedules by day
        $scheduleMap = [];
        foreach ($schedules as $s) {
            $scheduleMap[$s['day_of_week']] = $s;
        }

        return view('doctor/schedules', [
            'role' => 'doctor',
            'title' => 'Atur Jadwal Praktik',
            'scheduleMap' => $scheduleMap
        ]);
    }

    public function updateSchedule()
    {
        $userId = session()->get('user_id');
        $doctor = $this->doctorModel->where('user_id', $userId)->first();
        
        if (!$doctor) return redirect()->to('/auth/login');

        $scheduleModel = new \App\Models\DoctorScheduleModel();
        
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $activeDays = $this->request->getPost('active_days') ?? [];
        $startTimes = $this->request->getPost('start_time');
        $endTimes = $this->request->getPost('end_time');

        // Delete all old schedules
        $scheduleModel->where('doctor_id', $doctor['id'])->delete();

        // Insert new schedules
        foreach ($days as $day) {
            if (in_array($day, $activeDays)) {
                $start = $startTimes[$day] ?? '08:00';
                $end = $endTimes[$day] ?? '16:00';
                
                $scheduleModel->insert([
                    'doctor_id' => $doctor['id'],
                    'day_of_week' => $day,
                    'start_time' => $start,
                    'end_time' => $end,
                    'is_active' => true
                ]);
            }
        }

        return redirect()->to('doctor/schedules')->with('success', 'Jadwal praktik berhasil diperbarui.');
    }
    public function chat()
    {
        $appointmentId = $this->request->getGet('id');
        $userId = session()->get('user_id');
        
        if (!$appointmentId) {
            return redirect()->to('doctor/consultation')->with('error', 'Pilih jadwal konsultasi terlebih dahulu.');
        }

        $appointment = $this->appointmentModel
            ->select('appointments.*, users.name as patient_name, patients.gender')
            ->join('patients', 'patients.id = appointments.patient_id')
            ->join('users', 'users.id = patients.user_id')
            ->where('appointments.id', $appointmentId)
            ->first();

        if (!$appointment) {
            return redirect()->to('doctor/consultation')->with('error', 'Jadwal konsultasi tidak ditemukan.');
        }

        // Fetch or create consultation for this appointment
        $consultationModel = new \App\Models\ConsultationModel();
        $consultation = $consultationModel->where('appointment_id', $appointmentId)->first();
        
        if (!$consultation && $appointment['status'] !== 'completed') {
            $consultationModel->insert([
                'appointment_id' => $appointmentId,
                'diagnosis' => '',
                'notes' => '',
                'status' => 'active'
            ]);
            $consultation = $consultationModel->where('appointment_id', $appointmentId)->first();
        }

        $messages = [];
        if ($consultation) {
            $messageModel = new \App\Models\MessageModel();
            $messages = $messageModel->where('consultation_id', $consultation['id'])
                                     ->orderBy('created_at', 'ASC')
                                     ->findAll();
        }

        return view('doctor/chat', [
            'role' => 'doctor',
            'title' => 'Chat Pasien',
            'hide_sidebar' => true,
            'appointment' => $appointment,
            'messages' => $messages,
            'consultation' => $consultation
        ]);
    }

    public function endConsultation()
    {
        $appointmentId = $this->request->getPost('appointment_id');
        if (!$appointmentId) return redirect()->back()->with('error', 'Invalid appointment ID');
        
        $this->appointmentModel->update($appointmentId, ['status' => 'completed']);
        
        $consultationModel = new \App\Models\ConsultationModel();
        $consultation = $consultationModel->where('appointment_id', $appointmentId)->first();
        if ($consultation) {
            $consultationModel->update($consultation['id'], ['status' => 'completed']);
        }
        
        return redirect()->to('doctor/consultation')->with('success', 'Konsultasi selesai.');
    }

    public function prescriptionForm()
    {
        $appointmentId = $this->request->getGet('id');
        $appointment = $this->appointmentModel
            ->select('appointments.*, users.name as patient_name')
            ->join('patients', 'patients.id = appointments.patient_id')
            ->join('users', 'users.id = patients.user_id')
            ->where('appointments.id', $appointmentId)
            ->first();
            
        return view('doctor/prescription_form', [
            'role' => 'doctor',
            'title' => 'Buat Resep',
            'hide_sidebar' => true,
            'appointment' => $appointment
        ]);
    }

    public function writePrescription()
    {
        $appointmentId = $this->request->getPost('appointment_id');
        $diagnosis = $this->request->getPost('diagnosis');
        $medicineNames = $this->request->getPost('medicine_name'); 
        $dosages = $this->request->getPost('dosage');
        $frequencies = $this->request->getPost('frequency');
        $notes = $this->request->getPost('notes');

        $consultationModel = new \App\Models\ConsultationModel();
        $consultation = $consultationModel->where('appointment_id', $appointmentId)->first();
        
        if ($consultation) {
            $consultationModel->update($consultation['id'], ['diagnosis' => $diagnosis, 'doctor_notes' => $notes]);
            
            $prescriptionModel = new \App\Models\PrescriptionModel();
            $prescriptionModel->insert([
                'consultation_id' => $consultation['id'],
                'notes' => $notes,
                'status' => 'issued'
            ]);
            $prescriptionId = $prescriptionModel->getInsertID();

            $prescriptionItemModel = new \App\Models\PrescriptionItemModel();
            if (is_array($medicineNames)) {
                for ($i = 0; $i < count($medicineNames); $i++) {
                    if (!empty($medicineNames[$i])) {
                        $prescriptionItemModel->insert([
                            'prescription_id' => $prescriptionId,
                            'medicine_name' => $medicineNames[$i],
                            'dosage' => isset($dosages[$i]) ? $dosages[$i] : '',
                            'frequency' => isset($frequencies[$i]) ? $frequencies[$i] : '',
                            'duration' => 'Sesuai anjuran',
                            'quantity' => 1
                        ]);
                    }
                }
            }
        }
        
        // Also end consultation
        $this->appointmentModel->update($appointmentId, ['status' => 'completed']);
        if ($consultation) $consultationModel->update($consultation['id'], ['status' => 'completed']);

        return redirect()->to('doctor/consultation')->with('success', 'Resep berhasil dibuat dan konsultasi selesai.');
    }
}
