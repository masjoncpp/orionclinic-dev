<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTelemedicineTables extends Migration
{
    public function up()
    {
        // 1. Patients Table
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'date_of_birth' => ['type' => 'DATE', 'null' => true],
            'gender'      => ['type' => 'ENUM', 'constraint' => ['male', 'female'], 'default' => 'male'],
            'address'     => ['type' => 'TEXT', 'null' => true],
            'allergies'   => ['type' => 'TEXT', 'null' => true],
            'pre_existing_conditions' => ['type' => 'TEXT', 'null' => true],
            'emergency_contact' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('patients', true);

        // 2. Doctors Table
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'specialization' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'experience_years' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'str_number'  => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
            'sip_number'  => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
            'consultation_fee' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'default' => 0],
            'is_verified' => ['type' => 'BOOLEAN', 'default' => false],
            'status'      => ['type' => 'ENUM', 'constraint' => ['online', 'offline', 'busy'], 'default' => 'offline'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('doctors', true);

        // 3. Appointments Table
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'patient_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'doctor_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'appointment_date' => ['type' => 'DATE'],
            'time_slot'   => ['type' => 'TIME'],
            'reason'      => ['type' => 'TEXT', 'null' => true],
            'queue_number' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'status'      => ['type' => 'ENUM', 'constraint' => ['pending', 'confirmed', 'cancelled', 'completed'], 'default' => 'pending'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('patient_id', 'patients', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->addForeignKey('doctor_id', 'doctors', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('appointments', true);

        // 4. Consultations Table
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'appointment_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'doctor_notes' => ['type' => 'TEXT', 'null' => true],
            'diagnosis'   => ['type' => 'TEXT', 'null' => true],
            'status'      => ['type' => 'ENUM', 'constraint' => ['active', 'ended'], 'default' => 'active'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('appointment_id', 'appointments', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('consultations', true);

        // 5. Messages Table
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'consultation_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'sender_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'message'     => ['type' => 'TEXT'],
            'attachment_path' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'is_read'     => ['type' => 'BOOLEAN', 'default' => false],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('consultation_id', 'consultations', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sender_id', 'users', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('messages', true);

        // 6. Prescriptions Table
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'consultation_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'status'      => ['type' => 'ENUM', 'constraint' => ['issued', 'redeemed'], 'default' => 'issued'],
            'notes'       => ['type' => 'TEXT', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('consultation_id', 'consultations', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('prescriptions', true);

        // 7. Prescription Items Table
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'prescription_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'medicine_name' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'dosage'      => ['type' => 'VARCHAR', 'constraint' => '100'],
            'frequency'   => ['type' => 'VARCHAR', 'constraint' => '100'],
            'duration'    => ['type' => 'VARCHAR', 'constraint' => '100'],
            'quantity'    => ['type' => 'INT', 'constraint' => 11],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('prescription_id', 'prescriptions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('prescription_items', true);

        // 8. Medical Records Table
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'patient_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'consultation_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'blood_pressure' => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => true],
            'weight'      => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true],
            'height'      => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true],
            'summary'     => ['type' => 'TEXT'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('patient_id', 'patients', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->addForeignKey('consultation_id', 'consultations', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('medical_records', true);

        // 9. Payments Table
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'appointment_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'amount'      => ['type' => 'DECIMAL', 'constraint' => '15,2'],
            'payment_method' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
            'status'      => ['type' => 'ENUM', 'constraint' => ['pending', 'paid', 'failed'], 'default' => 'pending'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('appointment_id', 'appointments', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payments', true);

        // 10. Notifications Table
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'title'       => ['type' => 'VARCHAR', 'constraint' => '255'],
            'message'     => ['type' => 'TEXT'],
            'is_read'     => ['type' => 'BOOLEAN', 'default' => false],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('notifications', true);
    }

    public function down()
    {
        $this->forge->dropTable('notifications', true);
        $this->forge->dropTable('payments', true);
        $this->forge->dropTable('medical_records', true);
        $this->forge->dropTable('prescription_items', true);
        $this->forge->dropTable('prescriptions', true);
        $this->forge->dropTable('messages', true);
        $this->forge->dropTable('consultations', true);
        $this->forge->dropTable('appointments', true);
        $this->forge->dropTable('doctors', true);
        $this->forge->dropTable('patients', true);
    }
}
