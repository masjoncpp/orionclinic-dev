<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSpecializationsFamilyAuditTables extends Migration
{
    public function up()
    {
        // 1. Specializations Table
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => '100'],
            'description' => ['type' => 'TEXT', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('specializations', true);

        // 2. Family Members Table
        $this->forge->addField([
            'id'                      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'                 => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'name'                    => ['type' => 'VARCHAR', 'constraint' => '100'],
            'relation'                => ['type' => 'VARCHAR', 'constraint' => '50'],
            'date_of_birth'           => ['type' => 'DATE', 'null' => true],
            'gender'                  => ['type' => 'ENUM', 'constraint' => ['male', 'female'], 'default' => 'male'],
            'blood_type'              => ['type' => 'VARCHAR', 'constraint' => '5', 'null' => true],
            'allergies'               => ['type' => 'TEXT', 'null' => true],
            'pre_existing_conditions' => ['type' => 'TEXT', 'null' => true],
            'created_at'              => ['type' => 'DATETIME', 'null' => true],
            'updated_at'              => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('family_members', true);

        // 3. Audit Logs Table
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'action'     => ['type' => 'VARCHAR', 'constraint' => '100'],
            'details'    => ['type' => 'TEXT', 'null' => true],
            'ip_address' => ['type' => 'VARCHAR', 'constraint' => '45', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('audit_logs', true);
    }

    public function down()
    {
        $this->forge->dropTable('audit_logs', true);
        $this->forge->dropTable('family_members', true);
        $this->forge->dropTable('specializations', true);
    }
}
