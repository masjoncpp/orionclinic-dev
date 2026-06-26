<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PatientModel;
use App\Models\DoctorModel;
use App\Models\AppointmentModel;
use App\Models\PaymentModel;
use App\Models\SpecializationModel;
use App\Models\AuditLogModel;

class Admin extends BaseController
{
    private function logAction($action, $details = '')
    {
        $logModel = new AuditLogModel();
        $logModel->insert([
            'user_id' => session()->get('user_id'),
            'action' => $action,
            'details' => $details,
            'ip_address' => $this->request->getIPAddress(),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function index()
    {
        $userModel = new UserModel();
        $patientModel = new PatientModel();
        $doctorModel = new DoctorModel();
        $appointmentModel = new AppointmentModel();
        $paymentModel = new PaymentModel();

        $totalUsers = $userModel->countAllResults();
        $totalPatients = $patientModel->countAllResults();
        $totalDoctors = $doctorModel->countAllResults();
        
        $totalAppointments = $appointmentModel->where('status', 'completed')->countAllResults();
        
        $db = \Config\Database::connect();
        $query = $db->query("SELECT SUM(amount) as total_revenue FROM payments WHERE status = 'paid'");
        $totalRevenue = $query->getRow()->total_revenue ?? 0;

        // Get 5 recent transactions
        $recentTransactions = $paymentModel
            ->select('payments.*, users.name as patient_name')
            ->join('appointments', 'appointments.id = payments.appointment_id')
            ->join('patients', 'patients.id = appointments.patient_id')
            ->join('users', 'users.id = patients.user_id')
            ->orderBy('payments.created_at', 'DESC')
            ->limit(5)
            ->findAll();

        return view('admin/dashboard', [
            'title' => 'Admin Dashboard - Orion Clinic',
            'totalUsers' => $totalUsers,
            'totalPatients' => $totalPatients,
            'totalDoctors' => $totalDoctors,
            'totalAppointments' => $totalAppointments,
            'totalRevenue' => $totalRevenue,
            'recentTransactions' => $recentTransactions
        ]);
    }

    public function users()
    {
        $userModel = new UserModel();
        $users = $userModel->orderBy('created_at', 'DESC')->findAll();

        $this->logAction('View Users', 'Admin melihat daftar pengguna.');

        return view('admin/users', [
            'title' => 'Manajemen Pengguna - Orion Clinic',
            'users' => $users
        ]);
    }

    public function transactions()
    {
        $paymentModel = new PaymentModel();
        
        $transactions = $paymentModel
            ->select('payments.*, users.name as patient_name, doc_users.name as doctor_name')
            ->join('appointments', 'appointments.id = payments.appointment_id')
            ->join('patients', 'patients.id = appointments.patient_id')
            ->join('users', 'users.id = patients.user_id')
            ->join('doctors', 'doctors.id = appointments.doctor_id')
            ->join('users as doc_users', 'doc_users.id = doctors.user_id')
            ->orderBy('payments.created_at', 'DESC')
            ->findAll();

        $this->logAction('View Transactions', 'Admin melihat daftar transaksi.');

        return view('admin/transactions', [
            'title' => 'Laporan Keuangan - Orion Clinic',
            'transactions' => $transactions
        ]);
    }

    public function doctors()
    {
        $doctorModel = new DoctorModel();
        $doctors = $doctorModel
            ->select('doctors.*, users.name, users.email')
            ->join('users', 'users.id = doctors.user_id')
            ->orderBy('doctors.created_at', 'DESC')
            ->findAll();

        $specModel = new SpecializationModel();
        $specializations = $specModel->orderBy('name', 'ASC')->findAll();

        $this->logAction('View Doctors', 'Admin melihat daftar dokter.');

        return view('admin/doctors', [
            'title' => 'Kelola Dokter - Orion Clinic',
            'doctors' => $doctors,
            'specializations' => $specializations
        ]);
    }

    public function addDoctor()
    {
        $userModel = new UserModel();
        $doctorModel = new DoctorModel();

        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $specialization = $this->request->getPost('specialization');
        $experience = $this->request->getPost('experience_years');
        $str = $this->request->getPost('str_number');
        $sip = $this->request->getPost('sip_number');
        $fee = $this->request->getPost('consultation_fee');

        // Check if email already exists
        if ($userModel->where('email', $email)->first()) {
            return redirect()->back()->with('error', 'Email sudah terdaftar!');
        }

        // Insert into users table
        $userModel->insert([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'doctor',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $userId = $userModel->getInsertID();

        // Insert into doctors table
        $doctorModel->insert([
            'user_id' => $userId,
            'specialization' => $specialization,
            'experience_years' => $experience ?: 0,
            'str_number' => $str,
            'sip_number' => $sip,
            'consultation_fee' => $fee ?: 0,
            'is_verified' => 1, // Automatically verified if admin creates it
            'status' => 'offline',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $this->logAction('Add Doctor', "Admin menambahkan akun dokter baru: $name ($email).");

        return redirect()->back()->with('success', 'Akun dokter berhasil dibuat!');
    }

    public function verifyDoctor()
    {
        $doctorId = $this->request->getPost('doctor_id');
        $doctorModel = new DoctorModel();
        
        $doctor = $doctorModel->find($doctorId);
        if ($doctor) {
            $newStatus = $doctor['is_verified'] ? 0 : 1;
            $doctorModel->update($doctorId, ['is_verified' => $newStatus]);
            
            $statusText = $newStatus ? 'diverifikasi' : 'dicabut verifikasinya';
            $this->logAction('Verify Doctor', "Admin mengubah status verifikasi dokter ID $doctorId menjadi $statusText.");
            
            return redirect()->back()->with('success', 'Status verifikasi dokter berhasil diubah!');
        }
        
        return redirect()->back()->with('error', 'Dokter tidak ditemukan.');
    }

    public function patients()
    {
        $patientModel = new PatientModel();
        $patients = $patientModel
            ->select('patients.*, users.name, users.email')
            ->join('users', 'users.id = patients.user_id')
            ->orderBy('patients.created_at', 'DESC')
            ->findAll();

        $this->logAction('View Patients', 'Admin melihat daftar pasien.');

        return view('admin/patients', [
            'title' => 'Kelola Pasien - Orion Clinic',
            'patients' => $patients
        ]);
    }

    public function patientDetail($id)
    {
        $patientModel = new PatientModel();
        $patient = $patientModel
            ->select('patients.*, users.name, users.email, users.phone, users.created_at as user_created_at')
            ->join('users', 'users.id = patients.user_id')
            ->where('patients.id', $id)
            ->first();

        if (!$patient) {
            return redirect()->to('admin/patients')->with('error', 'Pasien tidak ditemukan.');
        }

        // Fetch medical history for this patient
        $appointmentModel = new AppointmentModel();
        $history = $appointmentModel
            ->select('appointments.*, users.name as doctor_name, doctors.specialization, consultations.diagnosis, consultations.follow_up, consultations.status as consultation_status')
            ->join('doctors', 'doctors.id = appointments.doctor_id')
            ->join('users', 'users.id = doctors.user_id')
            ->join('consultations', 'consultations.appointment_id = appointments.id', 'left')
            ->where('patient_id', $id)
            ->orderBy('appointment_date', 'DESC')
            ->orderBy('time_slot', 'DESC')
            ->findAll();

        $this->logAction('View Patient Detail', "Admin melihat detail pasien ID: $id.");

        return view('admin/patient_detail', [
            'title' => 'Detail Pasien - Orion Clinic',
            'patient' => $patient,
            'history' => $history
        ]);
    }

    public function specializations()
    {
        $specModel = new SpecializationModel();
        $specializations = $specModel->orderBy('name', 'ASC')->findAll();

        $this->logAction('View Specializations', 'Admin melihat daftar spesialisasi.');

        return view('admin/specializations', [
            'title' => 'Kelola Spesialisasi - Orion Clinic',
            'specializations' => $specializations
        ]);
    }

    public function addSpecialization()
    {
        $name = $this->request->getPost('name');
        
        if ($name) {
            $specModel = new SpecializationModel();
            $specModel->insert(['name' => $name]);
            
            $this->logAction('Add Specialization', "Admin menambahkan spesialisasi: $name.");
            
            return redirect()->back()->with('success', 'Spesialisasi berhasil ditambahkan!');
        }
        
        return redirect()->back()->with('error', 'Nama spesialisasi tidak boleh kosong.');
    }

    public function logs()
    {
        $logModel = new AuditLogModel();
        $logs = $logModel
            ->select('audit_logs.*, users.name as user_name, users.role as user_role')
            ->join('users', 'users.id = audit_logs.user_id', 'left')
            ->orderBy('audit_logs.created_at', 'DESC')
            ->limit(100)
            ->findAll();

        $this->logAction('View Logs', 'Admin melihat riwayat log aktivitas.');

        return view('admin/logs', [
            'title' => 'Audit Log Aktivitas - Orion Clinic',
            'logs' => $logs
        ]);
    }
}
