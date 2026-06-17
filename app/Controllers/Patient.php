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
            $upcoming = $this->appointmentModel
                ->select('appointments.*, users.name as doctor_name, doctors.specialization')
                ->join('doctors', 'doctors.id = appointments.doctor_id')
                ->join('users', 'users.id = doctors.user_id')
                ->where('patient_id', $patient['id'])
                ->where('appointment_date >=', date('Y-m-d'))
                ->where('appointments.status', 'confirmed')
                ->orderBy('appointment_date', 'ASC')
                ->orderBy('time_slot', 'ASC')
                ->limit(3)
                ->findAll();
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

        return view('patient/consultation', [
            'title'   => 'Konsultasi - Orion Clinic',
            'doctors' => $doctors
        ]); 
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
    public function profile()      { return view('patient/profile',      ['title' => 'Profil - Orion Clinic']); }
    public function chat()
    {
        $appointmentId = $this->request->getGet('id');
        $userId = session()->get('user_id');
        
        if (!$appointmentId) {
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
