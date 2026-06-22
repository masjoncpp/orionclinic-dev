<?php namespace App\Controllers;

use App\Models\DoctorModel;
use App\Models\AppointmentModel;
use App\Models\NotificationModel;

class Patient extends BaseController
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
        
        // Fetch all doctors with their user names
        $doctors = $this->doctorModel->select('doctors.*, users.name')
                                    ->join('users', 'users.id = doctors.user_id')
                                    ->where('is_verified', true)
                                    ->findAll();

        // Fetch upcoming appointments for this patient
        // First find patient_id from user_id
        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->where('user_id', $userId)->first();
        
        $upcoming = [];
        if ($patient) {
            $upcomingRaw = $this->appointmentModel
                ->select('appointments.*, users.name as doctor_name, doctors.specialization, doctors.status as doctor_status')
                ->join('doctors', 'doctors.id = appointments.doctor_id')
                ->join('users', 'users.id = doctors.user_id')
                ->where('patient_id', $patient['id'])
                ->where('appointment_date >=', date('Y-m-d'))
                ->where('appointments.status', 'confirmed')
                ->orderBy('appointment_date', 'ASC')
                ->orderBy('time_slot', 'ASC')
                ->findAll();

            $seenDoctors = [];
            foreach ($upcomingRaw as $apt) {
                if (!isset($seenDoctors[$apt['doctor_id']])) {
                    $upcoming[] = $apt;
                    $seenDoctors[$apt['doctor_id']] = true;
                }
                if (count($upcoming) >= 3) break;
            }
        }

        return view('patient/home', [
            'title'    => 'Beranda - Orion Clinic',
            'doctors'  => $doctors,
            'upcoming' => $upcoming
        ]);
    }
    
    public function consultation() 
    { 
        $doctorModel = new DoctorModel();
        
        // Fetch all doctors with their user names
        $doctors = $doctorModel->select('doctors.*, users.name')
                              ->join('users', 'users.id = doctors.user_id')
                              ->findAll();

        $scheduleModel = new \App\Models\DoctorScheduleModel();
        $schedules = $scheduleModel->where('is_active', true)->findAll();
        
        $doctorSchedules = [];
        foreach ($schedules as $s) {
            $doctorSchedules[$s['doctor_id']][] = $s;
        }

        foreach ($doctors as &$doc) {
            $doc['schedules'] = $doctorSchedules[$doc['id']] ?? [];
        }

        return view('patient/consultation', [
            'title'   => 'Konsultasi - Orion Clinic',
            'doctors' => $doctors
        ]); 
    }

    public function bookAppointment()
    {
        $doctorId = $this->request->getPost('doctor_id');
        $reason = $this->request->getPost('reason') ?? 'Konsultasi Umum';
        $appointmentDate = $this->request->getPost('appointment_date') ?? date('Y-m-d');
        $timeSlot = $this->request->getPost('time_slot') ?? date('H:i:s');
        
        $userId = session()->get('user_id');
        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->where('user_id', $userId)->first();
        
        if (!$patient || !$doctorId) {
            return redirect()->back()->with('error', 'Gagal membuat sesi konsultasi.');
        }

        // Validate Schedule
        $scheduleModel = new \App\Models\DoctorScheduleModel();
        $daysIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $dayIndex = date('w', strtotime($appointmentDate));
        $dayName = $daysIndo[$dayIndex];

        $schedule = $scheduleModel->where('doctor_id', $doctorId)
                                  ->where('day_of_week', $dayName)
                                  ->where('is_active', true)
                                  ->first();

        if (!$schedule) {
            return redirect()->back()->with('error', "Dokter tidak memiliki jadwal praktik pada hari $dayName.");
        }

        $timeInput = date('H:i:s', strtotime($timeSlot));
        $endTime = $schedule['end_time'];
        
        // Handle midnight as the end of the day
        if ($endTime === '00:00:00') {
            $endTime = '23:59:59';
        }

        if ($timeInput < $schedule['start_time'] || $timeInput > $endTime) {
            $startFormatted = date('H:i', strtotime($schedule['start_time']));
            $endFormatted = date('H:i', strtotime($schedule['end_time']));
            return redirect()->back()->with('error', "Waktu dipilih di luar jam praktik dokter ($startFormatted - $endFormatted WIB).");
        }

        // Generate unique queue number
        $queueStr = 'Q-' . strtoupper(substr(md5(uniqid()), 0, 4));

        $appointmentData = [
            'patient_id' => $patient['id'],
            'doctor_id' => $doctorId,
            'appointment_date' => $appointmentDate,
            'time_slot' => $timeSlot,
            'reason' => $reason,
            'queue_number' => $queueStr,
            'status' => 'pending' // Menunggu konfirmasi dokter
        ];
        
        $this->appointmentModel->insert($appointmentData);
        $appointmentId = $this->appointmentModel->getInsertID();

        return redirect()->to('patient/chat?id=' . $appointmentId);
    }

    public function prescription()
    {
        $userId = session()->get('user_id');
        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->where('user_id', $userId)->first();
        
        $prescriptions = [];
        if ($patient) {
            $prescriptionModel = new \App\Models\PrescriptionModel();
            $prescriptions = $prescriptionModel
                ->select('prescriptions.*, users.name as doctor_name, consultations.diagnosis')
                ->join('consultations', 'consultations.id = prescriptions.consultation_id')
                ->join('appointments', 'appointments.id = consultations.appointment_id')
                ->join('doctors', 'doctors.id = appointments.doctor_id')
                ->join('users', 'users.id = doctors.user_id')
                ->where('appointments.patient_id', $patient['id'])
                ->orderBy('prescriptions.created_at', 'DESC')
                ->findAll();

            // Fetch items for each prescription
            $itemModel = new \App\Models\PrescriptionItemModel();
            foreach ($prescriptions as &$p) {
                $p['items'] = $itemModel->where('prescription_id', $p['id'])->findAll();
                $p['total_cost'] = 0; // In real app, you might have medicine prices
            }
        }

        return view('patient/prescription', [
            'title'         => 'Resep Obat - Orion Clinic',
            'prescriptions' => $prescriptions
        ]);
    }
    public function history()
    {
        $userId = session()->get('user_id');
        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->where('user_id', $userId)->first();
        
        $history = [];
        if ($patient) {
            $history = $this->appointmentModel
                ->select('appointments.*, users.name as doctor_name, doctors.specialization, consultations.diagnosis, consultations.status as consultation_status')
                ->join('doctors', 'doctors.id = appointments.doctor_id')
                ->join('users', 'users.id = doctors.user_id')
                ->join('consultations', 'consultations.appointment_id = appointments.id', 'left')
                ->where('patient_id', $patient['id'])
                ->orderBy('appointment_date', 'DESC')
                ->orderBy('time_slot', 'DESC')
                ->findAll();
        }

        return view('patient/history', [
            'title'   => 'Riwayat - Orion Clinic',
            'history' => $history
        ]);
    }

    public function historyDetail()
    {
        $appointmentId = $this->request->getGet('id');
        $userId = session()->get('user_id');
        
        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->where('user_id', $userId)->first();
        
        if (!$patient || !$appointmentId) {
            return redirect()->to('patient/history')->with('error', 'Data tidak ditemukan.');
        }

        $appointment = $this->appointmentModel
            ->select('appointments.*, users.name as doctor_name, doctors.specialization')
            ->join('doctors', 'doctors.id = appointments.doctor_id')
            ->join('users', 'users.id = doctors.user_id')
            ->where('appointments.id', $appointmentId)
            ->where('appointments.patient_id', $patient['id'])
            ->first();

        if (!$appointment) {
            return redirect()->to('patient/history')->with('error', 'Riwayat tidak ditemukan.');
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

        return view('patient/history_detail', [
            'title'             => 'Detail Riwayat - Orion Clinic',
            'hide_sidebar'      => true,
            'appointment'       => $appointment,
            'consultation'      => $consultation,
            'prescription'      => $prescription,
            'prescriptionItems' => $prescriptionItems
        ]);
    }

    public function profile()      { return view('patient/profile',      ['title' => 'Profil - Orion Clinic']); }
    public function chat()
    {
        $appointmentId = $this->request->getGet('id');
        $userId = session()->get('user_id');
        
        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->where('user_id', $userId)->first();
        
        if (!$appointmentId) {
            // Find active appointment today
            if ($patient) {
                $activeAppointment = $this->appointmentModel
                    ->where('patient_id', $patient['id'])
                    ->where('appointment_date', date('Y-m-d'))
                    ->where('status', 'confirmed')
                    ->first();
                    
                if ($activeAppointment) {
                    return redirect()->to('patient/chat?id=' . $activeAppointment['id']);
                }
            }
            return redirect()->to('patient/consultation')->with('error', 'Pilih jadwal konsultasi terlebih dahulu.');
        }

        $appointment = $this->appointmentModel
            ->select('appointments.*, users.name as doctor_name, doctors.status as doctor_status')
            ->join('doctors', 'doctors.id = appointments.doctor_id')
            ->join('users', 'users.id = doctors.user_id')
            ->where('appointments.id', $appointmentId)
            ->first();

        if (!$appointment) {
            return redirect()->to('patient/consultation')->with('error', 'Jadwal konsultasi tidak ditemukan.');
        }

        // Fetch or create consultation for this appointment
        $consultationModel = new \App\Models\ConsultationModel();
        $consultation = $consultationModel->where('appointment_id', $appointmentId)->first();
        
        if (!$consultation && $appointment['status'] === 'confirmed') {
            $consultationModel->insert([
                'appointment_id' => $appointmentId,
                'diagnosis' => '',
                'doctor_notes' => '',
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

        return view('patient/chat', [
            'title'   => 'Chat Dokter - Orion Clinic',
            'hide_sidebar' => true,
            'appointment' => $appointment,
            'messages' => $messages,
            'consultation' => $consultation
        ]);
    }
    public function wellness()     { return view('patient/wellness',     ['title' => 'Wellness - Orion Clinic']); }
}
