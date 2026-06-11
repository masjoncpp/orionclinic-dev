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
    public function profile()      { return view('doctor/profile',      ['role' => 'doctor', 'title' => 'Profil Dokter']); }
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

        // Fetch real messages for this consultation
        $consultationModel = new \App\Models\ConsultationModel();
        $consultation = $consultationModel->where('appointment_id', $appointmentId)->first();
        
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
}
