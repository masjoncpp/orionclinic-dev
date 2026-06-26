<?php

namespace App\Controllers;

use App\Models\PrescriptionModel;
use App\Models\PrescriptionItemModel;
use App\Models\ConsultationModel;
use App\Models\AppointmentModel;
use App\Models\UserModel;
use App\Models\NotificationModel;

class Pharmacy extends BaseController
{
    public function index()
    {
        $prescriptionModel = new PrescriptionModel();
        
        // Fetch prescriptions that are paid (redeemed), preparing, or ready
        // 'redeemed' means it has been paid by the patient and is waiting for pharmacy to process
        // We will show 'redeemed', 'preparing', 'ready', 'completed' in different tabs or lists
        $prescriptionsRaw = $prescriptionModel
            ->select('prescriptions.*, consultations.diagnosis, appointments.appointment_date, users.name as patient_name, doc_users.name as doctor_name, appointments.patient_id')
            ->join('consultations', 'consultations.id = prescriptions.consultation_id')
            ->join('appointments', 'appointments.id = consultations.appointment_id')
            ->join('patients', 'patients.id = appointments.patient_id')
            ->join('users', 'users.id = patients.user_id')
            ->join('doctors', 'doctors.id = appointments.doctor_id')
            ->join('users as doc_users', 'doc_users.id = doctors.user_id')
            ->whereIn('prescriptions.status', ['redeemed', 'preparing', 'ready', 'completed'])
            ->orderBy('prescriptions.updated_at', 'DESC')
            ->findAll();

        $itemModel = new PrescriptionItemModel();
        foreach ($prescriptionsRaw as &$p) {
            $p['items'] = $itemModel->where('prescription_id', $p['id'])->findAll();
        }

        return view('pharmacy/dashboard', [
            'title' => 'Dashboard Farmasi - Orion Clinic',
            'prescriptions' => $prescriptionsRaw
        ]);
    }

    public function updateStatus()
    {
        $prescriptionId = $this->request->getPost('prescription_id');
        $newStatus = $this->request->getPost('status');

        $prescriptionModel = new PrescriptionModel();
        $prescription = $prescriptionModel->find($prescriptionId);

        if ($prescription) {
            $prescriptionModel->update($prescriptionId, ['status' => $newStatus]);

            // If updating status, notify the patient
            $consultationModel = new ConsultationModel();
            $consultation = $consultationModel->find($prescription['consultation_id']);
            
            if ($consultation) {
                $appointmentModel = new AppointmentModel();
                $appointment = $appointmentModel->find($consultation['appointment_id']);
                
                if ($appointment) {
                    $patientModel = new \App\Models\PatientModel();
                    $patient = $patientModel->find($appointment['patient_id']);
                    
                    if ($patient) {
                        $notificationModel = new NotificationModel();
                        $message = '';
                        if ($newStatus == 'preparing') {
                            $message = 'Obat Anda sedang disiapkan oleh Farmasi.';
                        } elseif ($newStatus == 'ready') {
                            $message = 'Obat Anda telah siap! Silakan ambil di apotek klinik.';
                        } elseif ($newStatus == 'completed') {
                            $message = 'Obat telah diserahkan.';
                        }

                        if ($message != '') {
                            $notificationModel->insert([
                                'user_id' => $patient['user_id'],
                                'title' => 'Update Status Obat',
                                'message' => $message,
                                'type' => 'prescription',
                                'is_read' => 0
                            ]);
                        }
                    }
                }
            }

            return redirect()->back()->with('success', 'Status resep berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Resep tidak ditemukan.');
    }
}
