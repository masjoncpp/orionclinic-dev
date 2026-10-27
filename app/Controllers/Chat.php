<?php

namespace App\Controllers;

use App\Models\MessageModel;
use App\Models\ConsultationModel;

class Chat extends BaseController
{
    protected $messageModel;
    protected $consultationModel;

    public function __construct()
    {
        $this->messageModel = new MessageModel();
        $this->consultationModel = new ConsultationModel();
    }

    private function getAuthorizedConsultation(int $consultationId, int $userId): ?array
    {
        return $this->consultationModel
            ->select('consultations.*, patients.user_id as patient_user_id, doctors.user_id as doctor_user_id')
            ->join('appointments', 'appointments.id = consultations.appointment_id')
            ->join('patients', 'patients.id = appointments.patient_id')
            ->join('doctors', 'doctors.id = appointments.doctor_id')
            ->where('consultations.id', $consultationId)
            ->groupStart()
                ->where('patients.user_id', $userId)
                ->orWhere('doctors.user_id', $userId)
            ->groupEnd()
            ->first();
    }

    /**
     * API to send a message
     */
    public function send()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request']);
        }

        $userId = (int) session()->get('user_id');
        $consultationId = (int) $this->request->getPost('consultation_id');
        $messageText = trim((string) $this->request->getPost('message'));
        
        $attachment = $this->request->getFile('attachment');

        if (!$consultationId || ($messageText === '' && (!$attachment || !$attachment->isValid()))) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Missing data']);
        }

        // Verify consultation is active and belongs to sender
        $consultation = $this->getAuthorizedConsultation($consultationId, $userId);
        if (!$consultation || $consultation['status'] !== 'active') {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Konsultasi sudah berakhir atau akses ditolak.']);
        }

        $attachmentPath = null;
        if ($attachment && $attachment->isValid() && !$attachment->hasMoved()) {
            $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'application/pdf'];
            $allowedExts  = ['jpg', 'jpeg', 'png', 'webp', 'pdf'];
            $ext = strtolower($attachment->getExtension());
            if (!in_array($attachment->getMimeType(), $allowedMimes, true) || !in_array($ext, $allowedExts, true) || $attachment->getSizeByUnit('kb') > 5120) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Format file harus JPG/PNG/WEBP/PDF (maks 5MB).']);
            }
            $newName = $attachment->getRandomName();
            $attachment->move(FCPATH . 'uploads/chat', $newName);
            $attachmentPath = 'uploads/chat/' . $newName;
        }

        $data = [
            'consultation_id' => $consultationId,
            'sender_id'       => $userId,
            'message'         => $messageText,
            'attachment_path' => $attachmentPath,
            'created_at'      => date('Y-m-d H:i:s'),
        ];

        if ($this->messageModel->insert($data)) {
            $data['id'] = $this->messageModel->getInsertID();
            return $this->response->setJSON(['status' => 'success', 'data' => $data]);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save message']);
    }

    /**
     * API to fetch new messages
     */
    public function get_updates()
    {
        $userId = (int) session()->get('user_id');
        $consultationId = (int) $this->request->getGet('consultation_id');
        $lastId = (int) ($this->request->getGet('last_id') ?? 0);

        if (!$consultationId || !$this->getAuthorizedConsultation($consultationId, $userId)) {
            return $this->response->setJSON([]);
        }

        $messages = $this->messageModel
            ->where('consultation_id', $consultationId)
            ->where('id >', $lastId)
            ->orderBy('created_at', 'ASC')
            ->findAll();

        return $this->response->setJSON($messages);
    }
}
