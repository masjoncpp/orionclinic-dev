<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TelemedicineSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $now = date('Y-m-d H:i:s');

        // 1. Seed Specializations
        $specializations = [
            ['name' => 'Dokter Umum', 'description' => 'Konsultasi keluhan umum dan rujukan awal.'],
            ['name' => 'Spesialis Anak (Sp.A)', 'description' => 'Kesehatan bayi, anak, dan tumbuh kembang.'],
            ['name' => 'Spesialis Jantung (Sp.JP)', 'description' => 'Kesehatan kardiovaskular dan sirkulasi darah.'],
            ['name' => 'Spesialis Penyakit Dalam (Sp.PD)', 'description' => 'Organ internal dewasa dan metabolik.'],
            ['name' => 'Spesialis Kulit & Kelamin (Sp.KK)', 'description' => 'Kesehatan kulit, rambut, dan alergi.'],
        ];

        foreach ($specializations as $spec) {
            $existing = $db->table('specializations')->where('name', $spec['name'])->get()->getRowArray();
            if (!$existing) {
                $db->table('specializations')->insert([
                    'name'        => $spec['name'],
                    'description' => $spec['description'],
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ]);
            }
        }

        // 2. Create Admin User
        $adminUser = $db->table('users')->where('email', 'admin@clinic.com')->get()->getRowArray();
        if (!$adminUser) {
            $db->table('users')->insert([
                'name'       => 'Administrator Orion',
                'email'      => 'admin@clinic.com',
                'password'   => password_hash('admin123', PASSWORD_DEFAULT),
                'role'       => 'admin',
                'phone'      => '081100000001',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 3. Create Pharmacy User
        $pharmacyUser = $db->table('users')->where('email', 'farmasi@clinic.com')->get()->getRowArray();
        if (!$pharmacyUser) {
            $db->table('users')->insert([
                'name'       => 'Apoteker Orion Farma',
                'email'      => 'farmasi@clinic.com',
                'password'   => password_hash('farmasi123', PASSWORD_DEFAULT),
                'role'       => 'farmasi',
                'phone'      => '081100000002',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 4. Create Doctor Users & Profiles
        $doctorsData = [
            [
                'name'           => 'Dr. Sarah Wijaya',
                'email'          => 'sarah@clinic.com',
                'specialization' => 'Dokter Umum',
                'fee'            => 50000,
                'experience'     => 6,
            ],
            [
                'name'           => 'Dr. Andi Pratama, Sp.A',
                'email'          => 'andi@clinic.com',
                'specialization' => 'Spesialis Anak (Sp.A)',
                'fee'            => 100000,
                'experience'     => 12,
            ],
            [
                'name'           => 'Dr. Maya Sari, Sp.JP',
                'email'          => 'maya@clinic.com',
                'specialization' => 'Spesialis Jantung (Sp.JP)',
                'fee'            => 150000,
                'experience'     => 15,
            ],
        ];

        $doctorIds = [];
        foreach ($doctorsData as $doc) {
            $user = $db->table('users')->where('email', $doc['email'])->get()->getRowArray();
            if (!$user) {
                $db->table('users')->insert([
                    'name'       => $doc['name'],
                    'email'      => $doc['email'],
                    'password'   => password_hash('password123', PASSWORD_DEFAULT),
                    'role'       => 'doctor',
                    'phone'      => '0812345678' . rand(10, 99),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
                $userId = $db->insertID();
            } else {
                $userId = $user['id'];
            }

            $doctor = $db->table('doctors')->where('user_id', $userId)->get()->getRowArray();
            if (!$doctor) {
                $db->table('doctors')->insert([
                    'user_id'          => $userId,
                    'specialization'   => $doc['specialization'],
                    'experience_years' => $doc['experience'],
                    'str_number'       => 'STR' . rand(100000, 999999),
                    'sip_number'       => 'SIP' . rand(100000, 999999),
                    'consultation_fee' => $doc['fee'],
                    'is_verified'      => true,
                    'status'           => 'online',
                    'created_at'       => $now,
                    'updated_at'       => $now,
                ]);
                $doctorId = $db->insertID();
            } else {
                $doctorId = $doctor['id'];
            }
            $doctorIds[] = $doctorId;

            // Seed Doctor Schedules
            $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
            foreach ($days as $day) {
                $scheduleExists = $db->table('doctor_schedules')
                    ->where('doctor_id', $doctorId)
                    ->where('day_of_week', $day)
                    ->get()
                    ->getRowArray();

                if (!$scheduleExists) {
                    $db->table('doctor_schedules')->insert([
                        'doctor_id'   => $doctorId,
                        'day_of_week' => $day,
                        'start_time'  => '08:00:00',
                        'end_time'    => '17:00:00',
                        'is_active'   => true,
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ]);
                }
            }
        }

        // 5. Create Test Patient User
        $patientEmail = 'budi@gmail.com';
        $patientUser = $db->table('users')->where('email', $patientEmail)->get()->getRowArray();
        if (!$patientUser) {
            $db->table('users')->insert([
                'name'       => 'Budi Santoso',
                'email'      => $patientEmail,
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'role'       => 'patient',
                'phone'      => '089988776655',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $patientUserId = $db->insertID();
        } else {
            $patientUserId = $patientUser['id'];
        }

        $patient = $db->table('patients')->where('user_id', $patientUserId)->get()->getRowArray();
        if (!$patient) {
            $db->table('patients')->insert([
                'user_id'                 => $patientUserId,
                'date_of_birth'           => '1992-05-15',
                'gender'                  => 'male',
                'blood_type'              => 'O',
                'address'                 => 'Jl. Pahlawan No. 45, Semarang',
                'allergies'               => 'Penisilin',
                'pre_existing_conditions' => 'Asma ringan',
                'emergency_contact'       => 'Siti Rahmawati (Istri)',
                'emergency_contact_phone' => '081298765432',
                'created_at'              => $now,
                'updated_at'              => $now,
            ]);
            $patientId = $db->insertID();
        } else {
            $patientId = $patient['id'];
        }

        // 6. Create Family Member
        $familyExists = $db->table('family_members')->where('user_id', $patientUserId)->get()->getRowArray();
        if (!$familyExists) {
            $db->table('family_members')->insert([
                'user_id'                 => $patientUserId,
                'name'                    => 'Rizky Santoso',
                'relation'                => 'Anak',
                'date_of_birth'           => '2019-08-20',
                'gender'                  => 'male',
                'blood_type'              => 'O',
                'allergies'               => 'Dingin',
                'pre_existing_conditions' => 'Tidak ada',
                'created_at'              => $now,
                'updated_at'              => $now,
            ]);
        }

        // 7. Create Dummy Appointment & Transaction
        $firstDocId = $doctorIds[0] ?? 1;
        $appointmentExists = $db->table('appointments')->where('patient_id', $patientId)->get()->getRowArray();
        if (!$appointmentExists) {
            $db->table('appointments')->insert([
                'patient_id'       => $patientId,
                'doctor_id'        => $firstDocId,
                'appointment_date' => date('Y-m-d'),
                'time_slot'        => '09:30:00',
                'reason'           => 'Demam tinggi dan batuk berdahak sejak 2 hari.',
                'queue_number'     => 'Q-A101',
                'status'           => 'confirmed',
                'created_at'       => $now,
                'updated_at'       => $now,
            ]);
            $appointmentId = $db->insertID();

            // Payment for appointment
            $db->table('payments')->insert([
                'appointment_id' => $appointmentId,
                'type'           => 'consultation',
                'amount'         => 50000,
                'payment_method' => 'Transfer Bank (BCA)',
                'status'         => 'paid',
                'payment_date'   => $now,
                'created_at'     => $now,
                'updated_at'     => $now,
            ]);

            // Consultation Session
            $db->table('consultations')->insert([
                'appointment_id' => $appointmentId,
                'doctor_notes'   => 'Pasien mengalami ISPA ringan. Suhu tubuh 38.2C. Disarankan istirahat dan banyak minum air hangat.',
                'diagnosis'      => 'Infeksi Saluran Pernapasan Akut (ISPA)',
                'status'         => 'active',
                'created_at'     => $now,
                'updated_at'     => $now,
            ]);
            $consultationId = $db->insertID();

            // Initial Messages
            $db->table('messages')->insert([
                'consultation_id' => $consultationId,
                'sender_id'       => $patientUserId,
                'message'         => 'Halo Dokter, saya demam sejak 2 hari yang lalu dan tenggorokan sakit.',
                'is_read'         => true,
                'created_at'      => $now,
            ]);

            // Prescription
            $db->table('prescriptions')->insert([
                'consultation_id' => $consultationId,
                'status'          => 'issued',
                'notes'           => 'Diminum teratur setelah makan. Jika tidak kunjung membaik dalam 3 hari, harap kontrol kembali.',
                'created_at'      => $now,
                'updated_at'      => $now,
            ]);
            $prescriptionId = $db->insertID();

            // Prescription Items
            $db->table('prescription_items')->insertBatch([
                [
                    'prescription_id' => $prescriptionId,
                    'medicine_name'   => 'Paracetamol 500mg',
                    'dosage'          => '1 tablet',
                    'frequency'       => '3x sehari',
                    'duration'        => '3 hari',
                    'quantity'        => 10,
                ],
                [
                    'prescription_id' => $prescriptionId,
                    'medicine_name'   => 'Ambroxol 30mg',
                    'dosage'          => '1 tablet',
                    'frequency'       => '3x sehari sesudah makan',
                    'duration'        => '3 hari',
                    'quantity'        => 10,
                ],
            ]);

            // Medical Record
            $db->table('medical_records')->insert([
                'patient_id'      => $patientId,
                'consultation_id' => $consultationId,
                'blood_pressure'  => '120/80',
                'weight'          => 65.5,
                'height'          => 170.0,
                'summary'         => 'Keluhan demam dan batuk. Diagnosa ISPA. Diberikan terapi antipiretik dan mukolitik.',
                'created_at'      => $now,
                'updated_at'      => $now,
            ]);

            // Notification
            $db->table('notifications')->insert([
                'user_id'    => $patientUserId,
                'title'      => 'Janji Temu Dikonfirmasi',
                'message'    => 'Janji temu Anda telah dikonfirmasi oleh dokter. Sesi telemedisin siap dimulai.',
                'type'       => 'consultation',
                'is_read'    => false,
                'created_at' => $now,
            ]);
        }
    }
}
