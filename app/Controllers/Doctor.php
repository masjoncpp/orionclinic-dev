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
            'pending'     => $this->appointmentModel->where('doctor_id', $doctor['id'])
                                                    ->where('status', 'pending')
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

        $notificationModel = new \App\Models\NotificationModel();
        $unreadCount = $notificationModel->where('user_id', $userId)
                                         ->where('is_read', 0)
                                         ->countAllResults();

        return view('doctor/dashboard', [
            'role' => 'doctor',
            'title' => 'Dashboard Dokter',
            'doctor' => $doctor,
            'stats' => $stats,
            'upcoming' => $upcoming,
            'unread_count' => $unreadCount
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
        $userId = session()->get('user_id');
        $doctor = $this->doctorModel->where('user_id', $userId)->first();
        $appointmentId = $this->request->getPost('appointment_id');
        $appointment = $appointmentId ? $this->appointmentModel->find($appointmentId) : null;

        if (!$doctor || !$appointment || $appointment['doctor_id'] != $doctor['id']) {
            return redirect()->back()->with('error', 'ID janji temu tidak valid atau akses ditolak.');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        // Update appointment to confirmed
        $this->appointmentModel->update($appointmentId, ['status' => 'confirmed']);

        // Create consultation record for the chat if not exists
        $consultationModel = new \App\Models\ConsultationModel();
        if (!$consultationModel->where('appointment_id', $appointmentId)->first()) {
            $consultationModel->insert([
                'appointment_id' => $appointmentId,
                'diagnosis' => '',
                'doctor_notes' => '',
                'status' => 'active'
            ]);
        }

        // Notify patient
        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->find($appointment['patient_id']);
        if ($patient) {
            $notificationModel = new \App\Models\NotificationModel();
            $notificationModel->insert([
                'user_id' => $patient['user_id'],
                'title' => 'Sesi Konsultasi Dimulai',
                'message' => 'Dokter telah menyetujui sesi Anda. Silakan masuk ke ruang chat konsultasi.',
                'is_read' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        $db->transComplete();

        return redirect()->to('doctor/consultation')->with('success', 'Jadwal konsultasi berhasil diterima.');
    }

    public function rejectAppointment()
    {
        $userId = session()->get('user_id');
        $doctor = $this->doctorModel->where('user_id', $userId)->first();
        $appointmentId = $this->request->getPost('appointment_id');
        $appointment = $appointmentId ? $this->appointmentModel->find($appointmentId) : null;

        if (!$doctor || !$appointment || $appointment['doctor_id'] != $doctor['id']) {
            return redirect()->back()->with('error', 'ID janji temu tidak valid atau akses ditolak.');
        }

        $this->appointmentModel->update($appointmentId, ['status' => 'cancelled']);

        // Notify patient
        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->find($appointment['patient_id']);
        if ($patient) {
            $notificationModel = new \App\Models\NotificationModel();
            $notificationModel->insert([
                'user_id' => $patient['user_id'],
                'title' => 'Sesi Konsultasi Ditolak',
                'message' => 'Mohon maaf, dokter sedang tidak tersedia sehingga sesi konsultasi Anda dibatalkan.',
                'is_read' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

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

    public function patientProfile($patientId)
    {
        $userId = session()->get('user_id');
        $doctor = $this->doctorModel->where('user_id', $userId)->first();
        
        if (!$doctor || !$patientId) {
            return redirect()->to('doctor/consultation')->with('error', 'Akses ditolak.');
        }

        // Verify that this doctor has an appointment with this patient
        $hasAppointment = $this->appointmentModel
            ->where('patient_id', $patientId)
            ->where('doctor_id', $doctor['id'])
            ->first();

        if (!$hasAppointment) {
            return redirect()->to('doctor/consultation')->with('error', 'Anda tidak memiliki akses ke rekam medis pasien ini.');
        }

        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel
            ->select('patients.*, users.name, users.email, users.phone, users.created_at as user_created_at')
            ->join('users', 'users.id = patients.user_id')
            ->where('patients.id', $patientId)
            ->first();

        // Fetch medical history for this patient (all history, even from other doctors if relevant, or maybe just from this clinic)
        $history = $this->appointmentModel
            ->select('appointments.*, users.name as doctor_name, doctors.specialization, consultations.diagnosis, consultations.follow_up, consultations.status as consultation_status')
            ->join('doctors', 'doctors.id = appointments.doctor_id')
            ->join('users', 'users.id = doctors.user_id')
            ->join('consultations', 'consultations.appointment_id = appointments.id', 'left')
            ->where('patient_id', $patientId)
            ->orderBy('appointment_date', 'DESC')
            ->orderBy('time_slot', 'DESC')
            ->findAll();

        $backTo = $this->request->getGet('back_to');
        $chatId = $this->request->getGet('id');
        
        $backUrl = base_url('doctor/patients');
        if ($backTo === 'chat' && $chatId) {
            $backUrl = base_url('doctor/chat?id=' . $chatId);
        }

        return view('admin/patient_detail', [
            'title' => 'Rekam Medis Pasien - Orion Clinic',
            'patient' => $patient,
            'history' => $history,
            'hide_sidebar' => true,
            'back_url' => $backUrl
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
        $medicalRecord = null;
        if ($consultation) {
            $prescriptionModel = new \App\Models\PrescriptionModel();
            $prescription = $prescriptionModel->where('consultation_id', $consultation['id'])->first();
            
            if ($prescription) {
                $itemModel = new \App\Models\PrescriptionItemModel();
                $prescriptionItems = $itemModel->where('prescription_id', $prescription['id'])->findAll();
            }

            $medicalRecord = (new \App\Models\MedicalRecordModel())->where('consultation_id', $consultation['id'])->first();
        }

        return view('doctor/history_detail', [
            'role'              => 'doctor',
            'title'             => 'Detail Riwayat Pasien',
            'hide_sidebar'      => true,
            'appointment'       => $appointment,
            'consultation'      => $consultation,
            'prescription'      => $prescription,
            'prescriptionItems' => $prescriptionItems,
            'medicalRecord'     => $medicalRecord,
        ]);
    }
    public function profile()
    {
        $userId = session()->get('user_id');
        $userModel = new \App\Models\UserModel();
        $doctor = $this->doctorModel->where('user_id', $userId)->first();
        $user = $userModel->find($userId);

        return view('doctor/profile', [
            'role'   => 'doctor',
            'title'  => 'Profil Dokter',
            'doctor' => $doctor,
            'user'   => $user
        ]);
    }

    public function toggleStatus()
    {
        $userId = session()->get('user_id');
        $doctor = $this->doctorModel->where('user_id', $userId)->first();
        
        if ($doctor) {
            $newStatus = $doctor['status'] === 'online' ? 'offline' : 'online';
            $this->doctorModel->update($doctor['id'], ['status' => $newStatus]);
            return redirect()->to('doctor/profile')->with('success', 'Status berhasil diubah menjadi ' . ucfirst($newStatus));
        }

        return redirect()->to('doctor/profile')->with('error', 'Gagal mengubah status');
    }
    
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

        $db = \Config\Database::connect();
        $db->transStart();

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

        $db->transComplete();

        return redirect()->to('doctor/schedules')->with('success', 'Jadwal praktik berhasil diperbarui.');
    }
    public function chat()
    {
        $appointmentId = $this->request->getGet('id');
        $userId = session()->get('user_id');
        $doctor = $this->doctorModel->where('user_id', $userId)->first();
        
        if (!$doctor || !$appointmentId) {
            return redirect()->to('doctor/consultation')->with('error', 'Pilih jadwal konsultasi terlebih dahulu.');
        }

        $appointment = $this->appointmentModel
            ->select('appointments.*, users.name as patient_name, patients.gender')
            ->join('patients', 'patients.id = appointments.patient_id')
            ->join('users', 'users.id = patients.user_id')
            ->where('appointments.id', $appointmentId)
            ->where('appointments.doctor_id', $doctor['id'])
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
        $userId = session()->get('user_id');
        $doctor = $this->doctorModel->where('user_id', $userId)->first();
        $appointmentId = $this->request->getPost('appointment_id');
        $diagnosis = $this->request->getPost('diagnosis');
        $doctorNotes = $this->request->getPost('doctor_notes');
        $followUp = $this->request->getPost('follow_up');
        $bloodPressure = trim((string) $this->request->getPost('blood_pressure')) ?: null;
        $weight = $this->request->getPost('weight') ?: null;
        $height = $this->request->getPost('height') ?: null;
        
        $appointment = $appointmentId ? $this->appointmentModel->find($appointmentId) : null;
        if (!$doctor || !$appointment || $appointment['doctor_id'] != $doctor['id']) {
            return redirect()->back()->with('error', 'Invalid appointment ID');
        }
        
        $db = \Config\Database::connect();
        $db->transStart();

        $this->appointmentModel->update($appointmentId, ['status' => 'completed']);
        
        $consultationModel = new \App\Models\ConsultationModel();
        $consultation = $consultationModel->where('appointment_id', $appointmentId)->first();
        if ($consultation) {
            $consultationModel->update($consultation['id'], [
                'status' => 'ended',
                'diagnosis' => $diagnosis,
                'doctor_notes' => $doctorNotes,
                'follow_up' => $followUp
            ]);

            $medicalRecordModel = new \App\Models\MedicalRecordModel();
            $existingRecord = $medicalRecordModel->where('consultation_id', $consultation['id'])->first();
            $recordData = [
                'patient_id'      => $appointment['patient_id'],
                'consultation_id' => $consultation['id'],
                'blood_pressure'  => $bloodPressure,
                'weight'          => $weight,
                'height'          => $height,
                'summary'         => trim($diagnosis . ($doctorNotes ? " - $doctorNotes" : '')),
            ];
            if ($existingRecord) {
                $medicalRecordModel->update($existingRecord['id'], $recordData);
            } else {
                $medicalRecordModel->insert($recordData);
            }
        }

        $db->transComplete();
        
        return redirect()->to('doctor/consultation')->with('success', 'Konsultasi selesai dan rekam medis tersimpan.');
    }

    public function prescriptionForm()
    {
        $userId = session()->get('user_id');
        $doctor = $this->doctorModel->where('user_id', $userId)->first();
        $appointmentId = $this->request->getGet('id');
        $appointment = $doctor ? $this->appointmentModel
            ->select('appointments.*, users.name as patient_name')
            ->join('patients', 'patients.id = appointments.patient_id')
            ->join('users', 'users.id = patients.user_id')
            ->where('appointments.id', $appointmentId)
            ->where('appointments.doctor_id', $doctor['id'])
            ->first() : null;

        if (!$appointment) {
            return redirect()->to('doctor/consultation')->with('error', 'Jadwal konsultasi tidak ditemukan.');
        }
            
        return view('doctor/prescription_form', [
            'role' => 'doctor',
            'title' => 'Buat Resep',
            'hide_sidebar' => true,
            'appointment' => $appointment
        ]);
    }

    public function writePrescription()
    {
        $userId = session()->get('user_id');
        $doctor = $this->doctorModel->where('user_id', $userId)->first();
        $appointmentId = $this->request->getPost('appointment_id');
        $appointment = $appointmentId ? $this->appointmentModel->find($appointmentId) : null;

        if (!$doctor || !$appointment || $appointment['doctor_id'] != $doctor['id']) {
            return redirect()->to('doctor/consultation')->with('error', 'Akses ditolak.');
        }

        $diagnosis = $this->request->getPost('diagnosis');
        $medicineNames = $this->request->getPost('medicine_name'); 
        $dosages = $this->request->getPost('dosage');
        $frequencies = $this->request->getPost('frequency');
        $durations = $this->request->getPost('duration');
        $quantities = $this->request->getPost('quantity');
        $notes = $this->request->getPost('notes');
        $bloodPressure = trim((string) $this->request->getPost('blood_pressure')) ?: null;
        $weight = $this->request->getPost('weight') ?: null;
        $height = $this->request->getPost('height') ?: null;

        $db = \Config\Database::connect();
        $db->transStart();

        $consultationModel = new \App\Models\ConsultationModel();
        $consultation = $consultationModel->where('appointment_id', $appointmentId)->first();
        
        if ($consultation) {
            $consultationModel->update($consultation['id'], [
                'diagnosis' => $diagnosis,
                'doctor_notes' => $notes,
                'status' => 'ended'
            ]);
            
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
                        $qty = isset($quantities[$i]) && (int) $quantities[$i] > 0 ? (int) $quantities[$i] : 1;
                        $dur = !empty($durations[$i]) ? trim((string) $durations[$i]) : 'Sesuai anjuran';
                        $prescriptionItemModel->insert([
                            'prescription_id' => $prescriptionId,
                            'medicine_name' => $medicineNames[$i],
                            'dosage' => isset($dosages[$i]) ? $dosages[$i] : '',
                            'frequency' => isset($frequencies[$i]) ? $frequencies[$i] : '',
                            'duration' => $dur,
                            'quantity' => $qty
                        ]);
                    }
                }
            }

            $medicalRecordModel = new \App\Models\MedicalRecordModel();
            $existingRecord = $medicalRecordModel->where('consultation_id', $consultation['id'])->first();
            $recordData = [
                'patient_id'      => $appointment['patient_id'],
                'consultation_id' => $consultation['id'],
                'blood_pressure'  => $bloodPressure,
                'weight'          => $weight,
                'height'          => $height,
                'summary'         => trim($diagnosis . ($notes ? " - $notes" : '')),
            ];
            if ($existingRecord) {
                $medicalRecordModel->update($existingRecord['id'], $recordData);
            } else {
                $medicalRecordModel->insert($recordData);
            }
        }
        
        // Also end consultation
        $this->appointmentModel->update($appointmentId, ['status' => 'completed']);

        // Notify patient
        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->find($appointment['patient_id']);
        if ($patient) {
            $notificationModel = new \App\Models\NotificationModel();
            $notificationModel->insert([
                'user_id' => $patient['user_id'],
                'title' => 'Resep Dokter Diterbitkan',
                'message' => 'Dokter telah menyelesaikan sesi dan menerbitkan resep untuk Anda. Silakan cek menu Resep & Obat untuk menebusnya.',
                'is_read' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        $db->transComplete();

        return redirect()->to('doctor/consultation')->with('success', 'Resep berhasil dibuat dan konsultasi selesai.');
    }

    public function notifications()
    {
        $userId = session()->get('user_id');
        $notificationModel = new \App\Models\NotificationModel();
        
        $notifications = $notificationModel->where('user_id', $userId)
                                           ->orderBy('created_at', 'DESC')
                                           ->findAll();

        return view('patient/notifications', [
            'role' => 'doctor',
            'title' => 'Notifikasi - Orion Clinic',
            'notifications' => $notifications
        ]);
    }

    public function readAllNotifications()
    {
        $userId = session()->get('user_id');
        $notificationModel = new \App\Models\NotificationModel();
        
        $notificationModel->where('user_id', $userId)
                          ->where('is_read', 0)
                          ->set(['is_read' => 1])
                          ->update();

        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai dibaca.');
    }
}
