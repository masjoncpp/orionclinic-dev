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

    /**
     * API to send a message
     */
    public function send()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request']);
        }

        $userId = session()->get('user_id');
        $consultationId = $this->request->getPost('consultation_id');
        $messageText = $this->request->getPost('message');
        
        $attachment = $this->request->getFile('attachment');

        if (!$consultationId || (!$messageText && (!$attachment || !$attachment->isValid()))) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Missing data']);
        }

        // Verify consultation is active
        $consultation = $this->consultationModel->find($consultationId);
        if (!$consultation || $consultation['status'] !== 'active') {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Konsultasi sudah berakhir atau tidak ditemukan.']);
        }

        $attachmentPath = null;
        if ($attachment && $attachment->isValid() && !$attachment->hasMoved()) {
            $newName = $attachment->getRandomName();
            $attachment->move('uploads/chat', $newName);
            $attachmentPath = 'uploads/chat/' . $newName;
        }

        $data = [
            'consultation_id' => $consultationId,
            'sender_id'       => $userId,
            'message'         => $messageText ?? '',
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
        $consultationId = $this->request->getGet('consultation_id');
        $lastId = $this->request->getGet('last_id') ?? 0;

        if (!$consultationId) {
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
