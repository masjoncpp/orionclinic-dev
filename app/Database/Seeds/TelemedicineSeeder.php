<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TelemedicineSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // 1. Create Doctor Users
        $doctorData = [
            [
                'name'     => 'Dr. Sarah Wijaya',
                'email'    => 'sarah@clinic.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role'     => 'doctor',
                'phone'    => '081234567890',
            ],
            [
                'name'     => 'Dr. Andi Pratama, Sp.A',
                'email'    => 'andi@clinic.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role'     => 'doctor',
                'phone'    => '081234567891',
            ],
            [
                'name'     => 'Dr. Maya Sari, Sp.JP',
                'email'    => 'maya@clinic.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role'     => 'doctor',
                'phone'    => '081234567892',
            ],
        ];

        foreach ($doctorData as $data) {
            $db->table('users')->insert($data);
            $userId = $db->insertID();

            // Create Doctor Profile
            $profile = [
                'user_id'          => $userId,
                'specialization'   => $this->getSpecialization($data['name']),
                'experience_years' => rand(5, 20),
                'str_number'       => 'STR' . rand(100000, 999999),
                'sip_number'       => 'SIP' . rand(100000, 999999),
                'consultation_fee' => $this->getFee($data['name']),
                'is_verified'      => true,
                'status'           => rand(0, 1) ? 'online' : 'offline',
            ];
            $db->table('doctors')->insert($profile);
        }

        // 2. Create a Test Patient User
        $patientData = [
            'name'     => 'Budi Santoso',
            'email'    => 'budi@gmail.com',
            'password' => password_hash('password123', PASSWORD_DEFAULT),
            'role'     => 'patient',
            'phone'    => '089988776655',
        ];
        $db->table('users')->insert($patientData);
        $patientUserId = $db->insertID();

        // Create Patient Profile
        $patientProfile = [
            'user_id'       => $patientUserId,
            'date_of_birth' => '1990-05-15',
            'gender'        => 'male',
            'address'       => 'Jl. Merdeka No. 123, Jakarta',
            'emergency_contact' => '081122334455',
        ];
        $db->table('patients')->insert($patientProfile);
        $patientId = $db->insertID();

        // 3. Create a Dummy Appointment
        $firstDoctor = $db->table('doctors')->get()->getRowArray();
        $db->table('appointments')->insert([
            'patient_id'       => $patientId,
            'doctor_id'        => $firstDoctor['id'],
            'appointment_date' => date('Y-m-d'),
            'time_slot'        => '14:00:00',
            'reason'           => 'Demam dan flu',
            'queue_number'     => 1,
            'status'           => 'confirmed',
            'created_at'       => date('Y-m-d H:i:s'),
        ]);
    }

    private function getSpecialization($name)
    {
        if (strpos($name, 'Sp.A') !== false) return 'Spesialis Anak';
        if (strpos($name, 'Sp.JP') !== false) return 'Spesialis Jantung';
        return 'Dokter Umum';
    }

    private function getFee($name)
    {
        if (strpos($name, 'Sp.A') !== false) return 100000;
        if (strpos($name, 'Sp.JP') !== false) return 150000;
        return 50000;
    }
}
