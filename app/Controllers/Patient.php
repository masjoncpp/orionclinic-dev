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

        $notificationModel = new \App\Models\NotificationModel();
        $unreadCount = $notificationModel->where('user_id', $userId)
                                         ->where('is_read', 0)
                                         ->countAllResults();

        return view('patient/home', [
            'title'    => 'Beranda - Orion Clinic',
            'doctors'  => $doctors,
            'upcoming' => $upcoming,
            'unread_count' => $unreadCount
        ]);
    }
    
    public function consultation() 
    { 
        $doctorModel = new DoctorModel();
        $userId = session()->get('user_id');
        
        // Fetch verified doctors with their user names
        $doctors = $doctorModel->select('doctors.*, users.name')
                              ->join('users', 'users.id = doctors.user_id')
                              ->where('is_verified', true)
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

        $familyModel = new \App\Models\FamilyMemberModel();
        $familyMembers = $familyModel->where('user_id', $userId)->findAll();

        return view('patient/consultation', [
            'title'          => 'Konsultasi - Orion Clinic',
            'doctors'        => $doctors,
            'family_members' => $familyMembers,
        ]); 
    }

    public function bookAppointment()
    {
        $doctorId = $this->request->getPost('doctor_id');
        $reason = trim((string) ($this->request->getPost('reason') ?? 'Konsultasi Umum'));
        $appointmentDate = $this->request->getPost('appointment_date') ?? date('Y-m-d');
        $timeSlot = $this->request->getPost('time_slot') ?? date('H:i:s');
        $familyMemberId = $this->request->getPost('family_member_id');
        
        $userId = session()->get('user_id');
        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->where('user_id', $userId)->first();
        
        if (!$patient || !$doctorId) {
            return redirect()->back()->with('error', 'Gagal membuat sesi konsultasi.');
        }

        if (!empty($familyMemberId)) {
            $familyModel = new \App\Models\FamilyMemberModel();
            $member = $familyModel->where('id', $familyMemberId)->where('user_id', $userId)->first();
            if ($member) {
                $reason = "[Pasien Keluarga: {$member['name']} ({$member['relation']})] " . $reason;
            }
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

        // Prevent double-booking on the same doctor, date, and time slot
        $conflict = $this->appointmentModel
            ->where('doctor_id', $doctorId)
            ->where('appointment_date', $appointmentDate)
            ->where('time_slot', $timeInput)
            ->whereIn('status', ['unpaid', 'pending', 'confirmed'])
            ->first();

        if ($conflict) {
            return redirect()->back()->with('error', 'Slot waktu tersebut sudah dipesan pasien lain. Silakan pilih waktu lain.');
        }

        // Generate unique queue number
        $queueStr = 'Q-' . strtoupper(substr(md5(uniqid()), 0, 4));

        $db = \Config\Database::connect();
        $db->transStart();

        $appointmentData = [
            'patient_id' => $patient['id'],
            'doctor_id' => $doctorId,
            'appointment_date' => $appointmentDate,
            'time_slot' => $timeInput,
            'reason' => $reason,
            'queue_number' => $queueStr,
            'status' => 'unpaid' // Menunggu pembayaran
        ];
        
        $this->appointmentModel->insert($appointmentData);
        $appointmentId = $this->appointmentModel->getInsertID();

        // Generate Notification for booking
        $notificationModel = new \App\Models\NotificationModel();
        $notificationModel->insert([
            'user_id' => $userId,
            'title' => 'Booking Berhasil',
            'message' => "Anda telah berhasil membuat janji temu dengan dokter pada " . date('d M Y', strtotime($appointmentDate)) . " pukul $timeSlot.",
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Get doctor to find out consultation fee
        $doctor = $this->doctorModel->find($doctorId);
        $fee = $doctor['consultation_fee'] ?? 0;

        // Create pending payment
        $paymentModel = new \App\Models\PaymentModel();
        $paymentData = [
            'appointment_id' => $appointmentId,
            'amount' => $fee,
            'status' => 'pending'
        ];
        $paymentModel->insert($paymentData);
        $paymentId = $paymentModel->getInsertID();

        $db->transComplete();

        return redirect()->to('patient/payment?id=' . $paymentId);
    }

    public function cancelAppointment()
    {
        $userId = session()->get('user_id');
        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->where('user_id', $userId)->first();

        $appointmentId = $this->request->getPost('appointment_id');
        $appointment = $this->appointmentModel->find($appointmentId);

        if (!$patient || !$appointment || $appointment['patient_id'] != $patient['id'] || !in_array($appointment['status'], ['unpaid', 'pending', 'confirmed'])) {
            return redirect()->back()->with('error', 'Janji temu tidak dapat dibatalkan.');
        }

        $this->appointmentModel->update($appointmentId, ['status' => 'cancelled']);
        
        // Mark payment as cancelled too if exists
        $paymentModel = new \App\Models\PaymentModel();
        $payment = $paymentModel->where('appointment_id', $appointmentId)->first();
        if ($payment) {
            $paymentModel->update($payment['id'], ['status' => 'failed']);
        }

        $notificationModel = new \App\Models\NotificationModel();
        $notificationModel->insert([
            'user_id' => $patient['user_id'],
            'title' => 'Janji Temu Dibatalkan',
            'message' => "Janji temu Anda pada " . date('d M Y', strtotime($appointment['appointment_date'])) . " telah dibatalkan.",
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Janji temu berhasil dibatalkan.');
    }

    public function rescheduleAppointment()
    {
        $userId = session()->get('user_id');
        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->where('user_id', $userId)->first();

        $appointmentId = $this->request->getPost('appointment_id');
        $appointmentDate = $this->request->getPost('appointment_date');
        $timeSlot = $this->request->getPost('time_slot');

        $appointment = $this->appointmentModel->find($appointmentId);

        if (!$patient || !$appointment || $appointment['patient_id'] != $patient['id'] || !in_array($appointment['status'], ['unpaid', 'pending', 'confirmed'])) {
            return redirect()->back()->with('error', 'Janji temu tidak valid untuk dijadwalkan ulang.');
        }

        // Validate Schedule
        $scheduleModel = new \App\Models\DoctorScheduleModel();
        $daysIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $dayIndex = date('w', strtotime($appointmentDate));
        $dayName = $daysIndo[$dayIndex];

        $schedule = $scheduleModel->where('doctor_id', $appointment['doctor_id'])
                                  ->where('day_of_week', $dayName)
                                  ->where('is_active', true)
                                  ->first();

        if (!$schedule) {
            return redirect()->back()->with('error', "Dokter tidak memiliki jadwal praktik pada hari $dayName.");
        }

        $timeInput = date('H:i:s', strtotime($timeSlot));
        $endTime = $schedule['end_time'];
        if ($endTime === '00:00:00') $endTime = '23:59:59';

        if ($timeInput < $schedule['start_time'] || $timeInput > $endTime) {
            $startFormatted = date('H:i', strtotime($schedule['start_time']));
            $endFormatted = date('H:i', strtotime($schedule['end_time']));
            return redirect()->back()->with('error', "Waktu dipilih di luar jam praktik dokter ($startFormatted - $endFormatted WIB).");
        }

        $conflict = $this->appointmentModel
            ->where('doctor_id', $appointment['doctor_id'])
            ->where('appointment_date', $appointmentDate)
            ->where('time_slot', $timeInput)
            ->where('id !=', $appointmentId)
            ->whereIn('status', ['unpaid', 'pending', 'confirmed'])
            ->first();

        if ($conflict) {
            return redirect()->back()->with('error', 'Slot waktu tersebut sudah dipesan pasien lain.');
        }

        $this->appointmentModel->update($appointmentId, [
            'appointment_date' => $appointmentDate,
            'time_slot' => $timeInput
        ]);

        $notificationModel = new \App\Models\NotificationModel();
        $notificationModel->insert([
            'user_id' => $patient['user_id'],
            'title' => 'Janji Temu Dijadwalkan Ulang',
            'message' => "Janji temu Anda telah diubah menjadi tanggal " . date('d M Y', strtotime($appointmentDate)) . " pukul $timeSlot.",
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Janji temu berhasil dijadwalkan ulang.');
    }

    public function payment()
    {
        $paymentId = $this->request->getGet('id');
        $userId = session()->get('user_id');

        $patient = (new \App\Models\PatientModel())->where('user_id', $userId)->first();
        $paymentModel = new \App\Models\PaymentModel();
        $payment = $paymentModel->find($paymentId);

        if (!$patient || !$payment || $payment['status'] !== 'pending') {
            return redirect()->to('patient/history')->with('error', 'Tagihan tidak ditemukan atau sudah dibayar.');
        }

        $appointment = $this->appointmentModel
            ->select('appointments.*, users.name as doctor_name, doctors.specialization')
            ->join('doctors', 'doctors.id = appointments.doctor_id')
            ->join('users', 'users.id = doctors.user_id')
            ->where('appointments.id', $payment['appointment_id'])
            ->where('appointments.patient_id', $patient['id'])
            ->first();

        if (!$appointment) {
            return redirect()->to('patient/history')->with('error', 'Akses tagihan ditolak.');
        }

        return view('patient/payment', [
            'title' => 'Pembayaran - Orion Clinic',
            'hide_sidebar' => true,
            'payment' => $payment,
            'appointment' => $appointment
        ]);
    }

    public function processPayment()
    {
        $paymentId = $this->request->getPost('payment_id');
        $method = $this->request->getPost('payment_method');
        $userId = session()->get('user_id');

        $patient = (new \App\Models\PatientModel())->where('user_id', $userId)->first();
        $paymentModel = new \App\Models\PaymentModel();
        $payment = $paymentModel->find($paymentId);

        if ($patient && $payment && $payment['status'] === 'pending') {
            $appointment = $this->appointmentModel
                ->where('id', $payment['appointment_id'])
                ->where('patient_id', $patient['id'])
                ->first();

            if (!$appointment) {
                return redirect()->to('patient/history')->with('error', 'Akses pembayaran ditolak.');
            }
            
            $updateData = [
                'status' => 'paid',
                'payment_method' => $method,
                'payment_date' => date('Y-m-d H:i:s')
            ];

            // Handle File Upload if manual transfer
            if ($method === 'manual_transfer') {
                $file = $this->request->getFile('bukti_transfer');
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'application/pdf'];
                    $allowedExts  = ['jpg', 'jpeg', 'png', 'webp', 'pdf'];
                    $ext = strtolower($file->getExtension());
                    if (!in_array($file->getMimeType(), $allowedMimes, true) || !in_array($ext, $allowedExts, true) || $file->getSizeByUnit('kb') > 5120) {
                        return redirect()->back()->with('error', 'Bukti transfer harus berupa gambar (JPG/PNG/WEBP) atau PDF maksimal 5MB.');
                    }
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'uploads/payments', $newName);
                    $updateData['bukti_transfer'] = $newName;
                } else {
                    return redirect()->back()->with('error', 'Silakan upload bukti transfer yang valid.');
                }
            }

            $db = \Config\Database::connect();
            $db->transStart();

            $paymentModel->update($paymentId, $updateData);

            // Create notification for patient
            $notificationModel = new \App\Models\NotificationModel();
            
            if (isset($payment['type']) && $payment['type'] === 'prescription') {
                $notificationModel->insert([
                    'user_id' => $userId,
                    'title' => 'Pembayaran Resep Berhasil',
                    'message' => 'Pembayaran obat resep Anda telah lunas. Obat sedang disiapkan oleh farmasi klinik.',
                    'is_read' => 0,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $consultationModel = new \App\Models\ConsultationModel();
                $consultation = $consultationModel->where('appointment_id', $payment['appointment_id'])->first();
                if ($consultation) {
                    $prescriptionModel = new \App\Models\PrescriptionModel();
                    $prescription = $prescriptionModel->where('consultation_id', $consultation['id'])->first();
                    if ($prescription) {
                        $prescriptionModel->update($prescription['id'], ['status' => 'redeemed']);
                    }
                }
                $db->transComplete();
                return redirect()->to('patient/prescription')->with('success', 'Pembayaran berhasil! Obat Anda sedang dipersiapkan.');
            } else {
                $notificationModel->insert([
                    'user_id' => $userId,
                    'title' => 'Pembayaran Konsultasi Berhasil',
                    'message' => 'Pembayaran konsultasi Anda telah lunas. Silakan menunggu dokter menyetujui sesi Anda.',
                    'is_read' => 0,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $this->appointmentModel->update($payment['appointment_id'], [
                    'status' => 'pending' // Sekarang appointment masuk antrean dokter
                ]);

                // Notify doctor
                $doctorModel = new \App\Models\DoctorModel();
                $doctor = $doctorModel->find($appointment['doctor_id']);
                if ($doctor) {
                    $notificationModel->insert([
                        'user_id' => $doctor['user_id'],
                        'title' => 'Permintaan Konsultasi Baru',
                        'message' => 'Pasien telah melunasi pembayaran dan sedang menunggu Anda di ruang konsultasi.',
                        'is_read' => 0,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }

                $db->transComplete();
                return redirect()->to('patient/chat?id=' . $payment['appointment_id'])->with('success', 'Pembayaran berhasil! Menunggu dokter menerima konsultasi.');
            }
        }

        return redirect()->back()->with('error', 'Pembayaran gagal diproses.');
    }

    public function checkoutPrescription()
    {
        $userId = session()->get('user_id');
        $patient = (new \App\Models\PatientModel())->where('user_id', $userId)->first();
        $prescriptionId = $this->request->getPost('prescription_id');
        $prescriptionModel = new \App\Models\PrescriptionModel();
        $prescription = $prescriptionModel->find($prescriptionId);

        if (!$patient || !$prescription || $prescription['status'] !== 'issued') {
            return redirect()->back()->with('error', 'Resep tidak valid atau sudah ditebus.');
        }

        // Find appointment_id via consultation and verify ownership
        $consultationModel = new \App\Models\ConsultationModel();
        $consultation = $consultationModel->find($prescription['consultation_id']);
        $appointment = $consultation ? $this->appointmentModel->find($consultation['appointment_id']) : null;

        if (!$consultation || !$appointment || $appointment['patient_id'] != $patient['id']) {
            return redirect()->back()->with('error', 'Konsultasi tidak ditemukan.');
        }

        // Calculate cost
        $itemModel = new \App\Models\PrescriptionItemModel();
        $items = $itemModel->where('prescription_id', $prescriptionId)->findAll();
        $cost = 0;
        foreach ($items as $it) {
            $cost += ($it['quantity'] * 15000);
        }

        // Create pending payment for prescription
        $paymentModel = new \App\Models\PaymentModel();
        
        // Check if there's already a pending payment for this prescription
        $existing = $paymentModel->where('appointment_id', $consultation['appointment_id'])
                                 ->where('type', 'prescription')
                                 ->where('status', 'pending')
                                 ->first();
        
        if ($existing) {
            return redirect()->to('patient/payment?id=' . $existing['id']);
        }

        $paymentData = [
            'appointment_id' => $consultation['appointment_id'],
            'type' => 'prescription',
            'amount' => $cost,
            'status' => 'pending'
        ];
        
        $paymentModel->insert($paymentData);
        $paymentId = $paymentModel->getInsertID();

        return redirect()->to('patient/payment?id=' . $paymentId);
    }

    public function payments()
    {
        $userId = session()->get('user_id');
        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->where('user_id', $userId)->first();
        
        $payments = [];
        if ($patient) {
            $paymentModel = new \App\Models\PaymentModel();
            $payments = $paymentModel->select('payments.*, appointments.appointment_date, users.name as doctor_name, doctors.specialization')
                ->join('appointments', 'appointments.id = payments.appointment_id')
                ->join('doctors', 'doctors.id = appointments.doctor_id')
                ->join('users', 'users.id = doctors.user_id')
                ->where('appointments.patient_id', $patient['id'])
                ->orderBy('payments.created_at', 'DESC')
                ->findAll();
        }

        return view('patient/payments', [
            'title' => 'Riwayat Pembayaran - Orion Clinic',
            'payments' => $payments
        ]);
    }

    public function invoice()
    {
        $paymentId = $this->request->getGet('id');
        $userId = session()->get('user_id');

        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->select('patients.*, users.name as patient_name')
            ->join('users', 'users.id = patients.user_id')
            ->where('user_id', $userId)->first();

        $paymentModel = new \App\Models\PaymentModel();
        $payment = $paymentModel->select('payments.*, appointments.appointment_date, appointments.time_slot, users.name as doctor_name, doctors.specialization')
            ->join('appointments', 'appointments.id = payments.appointment_id')
            ->join('doctors', 'doctors.id = appointments.doctor_id')
            ->join('users', 'users.id = doctors.user_id')
            ->where('payments.id', $paymentId)
            ->where('appointments.patient_id', $patient['id'])
            ->first();

        if (!$payment) {
            return redirect()->to('patient/payments')->with('error', 'Invoice tidak ditemukan.');
        }

        $prescriptionItems = [];
        if ($payment['type'] == 'prescription') {
            $consultationModel = new \App\Models\ConsultationModel();
            $consultation = $consultationModel->where('appointment_id', $payment['appointment_id'])->first();
            if ($consultation) {
                $prescriptionModel = new \App\Models\PrescriptionModel();
                $prescription = $prescriptionModel->where('consultation_id', $consultation['id'])->first();
                if ($prescription) {
                    $itemModel = new \App\Models\PrescriptionItemModel();
                    $prescriptionItems = $itemModel->where('prescription_id', $prescription['id'])->findAll();
                }
            }
        }

        return view('patient/invoice', [
            'title' => 'Invoice - Orion Clinic',
            'hide_sidebar' => true,
            'payment' => $payment,
            'patient' => $patient,
            'prescriptionItems' => $prescriptionItems
        ]);
    }

    public function notifications()
    {
        $userId = session()->get('user_id');
        $notificationModel = new \App\Models\NotificationModel();
        
        $notifications = $notificationModel->where('user_id', $userId)
                                           ->orderBy('created_at', 'DESC')
                                           ->findAll();

        return view('patient/notifications', [
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

            // Fetch items for all prescriptions in a single query (avoid N+1)
            $itemModel = new \App\Models\PrescriptionItemModel();
            $prescriptionIds = array_column($prescriptions, 'id');
            $itemsByPrescription = [];
            if (!empty($prescriptionIds)) {
                foreach ($itemModel->whereIn('prescription_id', $prescriptionIds)->findAll() as $it) {
                    $itemsByPrescription[$it['prescription_id']][] = $it;
                }
            }
            foreach ($prescriptions as &$p) {
                $items = $itemsByPrescription[$p['id']] ?? [];
                $p['items'] = $items;
                $cost = 0;
                foreach ($items as $it) {
                    $cost += ($it['quantity'] * 15000);
                }
                $p['total_cost'] = $cost;
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
                ->select('appointments.*, users.name as doctor_name, doctors.specialization, consultations.diagnosis, consultations.status as consultation_status, payments.id as payment_id')
                ->join('doctors', 'doctors.id = appointments.doctor_id')
                ->join('users', 'users.id = doctors.user_id')
                ->join('consultations', 'consultations.appointment_id = appointments.id', 'left')
                ->join('payments', 'payments.appointment_id = appointments.id', 'left')
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

        return view('patient/history_detail', [
            'title'             => 'Detail Riwayat - Orion Clinic',
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
        $userModel = new \App\Models\UserModel();
        $patientModel = new \App\Models\PatientModel();
        $familyModel = new \App\Models\FamilyMemberModel();

        $userId = session()->get('user_id');
        $user = $userModel->find($userId);
        $patient = $patientModel->where('user_id', $userId)->first();
        $family_members = $familyModel->where('user_id', $userId)->findAll();

        return view('patient/profile', [
            'role' => 'patient',
            'title' => 'Profil Saya',
            'user' => $user,
            'patient' => $patient,
            'family_members' => $family_members
        ]);
    }

    public function editProfile()
    {
        $userId = session()->get('user_id');
        $userModel = new \App\Models\UserModel();
        $patientModel = new \App\Models\PatientModel();

        $user = $userModel->find($userId);
        $patient = $patientModel->where('user_id', $userId)->first();

        // Create empty patient record if doesn't exist
        if (!$patient) {
            $patientModel->insert(['user_id' => $userId]);
            $patient = $patientModel->where('user_id', $userId)->first();
        }

        return view('patient/edit_profile', [
            'role' => 'patient',
            'title' => 'Edit Profil',
            'user' => $user,
            'patient' => $patient,
            'hide_sidebar' => true
        ]);
    }

    public function updateProfile()
    {
        $userId = session()->get('user_id');
        
        $userModel = new \App\Models\UserModel();
        $patientModel = new \App\Models\PatientModel();
        
        $patient = $patientModel->where('user_id', $userId)->first();

        // Update User table (include id for is_unique validation placeholder)
        $updated = $userModel->update($userId, [
            'id'    => $userId,
            'name'  => trim((string) $this->request->getPost('name')),
            'email' => trim((string) $this->request->getPost('email')),
            'phone' => trim((string) $this->request->getPost('phone'))
        ]);

        if (!$updated) {
            $err = implode(' ', $userModel->errors());
            return redirect()->back()->withInput()->with('error', $err ?: 'Gagal memperbarui data akun.');
        }
        
        // Update session if changed
        session()->set([
            'name'  => trim((string) $this->request->getPost('name')),
            'email' => trim((string) $this->request->getPost('email')),
            'phone' => trim((string) $this->request->getPost('phone'))
        ]);

        // Update Patient table
        $patientData = [
            'date_of_birth' => $this->request->getPost('date_of_birth') ?: null,
            'gender'        => $this->request->getPost('gender'),
            'blood_type'    => $this->request->getPost('blood_type') ?: null,
            'address'       => $this->request->getPost('address'),
            'allergies'     => $this->request->getPost('allergies'),
            'pre_existing_conditions' => $this->request->getPost('pre_existing_conditions'),
            'emergency_contact' => $this->request->getPost('emergency_contact'),
            'emergency_contact_phone' => $this->request->getPost('emergency_contact_phone')
        ];

        if ($patient) {
            $patientModel->update($patient['id'], $patientData);
        } else {
            $patientData['user_id'] = $userId;
            $patientModel->insert($patientData);
        }

        return redirect()->to('patient/profile')->with('success', 'Profil kesehatan berhasil diperbarui.');
    }

    public function addFamilyMember()
    {
        $userId = session()->get('user_id');
        $familyModel = new \App\Models\FamilyMemberModel();

        $familyModel->insert([
            'user_id'                 => $userId,
            'name'                    => $this->request->getPost('name'),
            'relation'                => $this->request->getPost('relation'),
            'date_of_birth'           => $this->request->getPost('date_of_birth'),
            'gender'                  => $this->request->getPost('gender'),
            'blood_type'              => $this->request->getPost('blood_type'),
            'allergies'               => $this->request->getPost('allergies'),
            'pre_existing_conditions' => $this->request->getPost('pre_existing_conditions')
        ]);

        return redirect()->to('patient/profile')->with('success', 'Anggota keluarga berhasil ditambahkan.');
    }

    public function deleteFamilyMember($id)
    {
        $userId = session()->get('user_id');
        $familyModel = new \App\Models\FamilyMemberModel();

        $member = $familyModel->find($id);
        if ($member && $member['user_id'] == $userId) {
            $familyModel->delete($id);
            return redirect()->to('patient/profile')->with('success', 'Anggota keluarga berhasil dihapus.');
        }

        return redirect()->to('patient/profile')->with('error', 'Gagal menghapus anggota keluarga.');
    }

    public function chat()
    {
        $appointmentId = $this->request->getGet('id');
        $userId = session()->get('user_id');
        
        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->where('user_id', $userId)->first();
        
        if (!$patient) {
            return redirect()->to('patient/consultation')->with('error', 'Profil pasien tidak ditemukan.');
        }

        if (!$appointmentId) {
            // Find active appointment today
            $activeAppointment = $this->appointmentModel
                ->where('patient_id', $patient['id'])
                ->where('appointment_date', date('Y-m-d'))
                ->where('status', 'confirmed')
                ->first();
                
            if ($activeAppointment) {
                return redirect()->to('patient/chat?id=' . $activeAppointment['id']);
            }
            return redirect()->to('patient/consultation')->with('error', 'Pilih jadwal konsultasi terlebih dahulu.');
        }

        $appointment = $this->appointmentModel
            ->select('appointments.*, users.name as doctor_name, doctors.status as doctor_status')
            ->join('doctors', 'doctors.id = appointments.doctor_id')
            ->join('users', 'users.id = doctors.user_id')
            ->where('appointments.id', $appointmentId)
            ->where('appointments.patient_id', $patient['id'])
            ->first();

        if (!$appointment) {
            return redirect()->to('patient/consultation')->with('error', 'Jadwal konsultasi tidak ditemukan.');
        }

        if ($appointment['status'] === 'unpaid') {
            $paymentModel = new \App\Models\PaymentModel();
            $payment = $paymentModel->where('appointment_id', $appointmentId)->first();
            if ($payment) {
                return redirect()->to('patient/payment?id=' . $payment['id']);
            }
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
