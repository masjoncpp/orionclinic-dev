<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDoctorSchedulesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'doctor_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'day_of_week' => ['type' => 'VARCHAR', 'constraint' => 20], // 'Senin', 'Selasa', dll.
            'start_time'  => ['type' => 'TIME'],
            'end_time'    => ['type' => 'TIME'],
            'is_active'   => ['type' => 'BOOLEAN', 'default' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('doctor_id', 'doctors', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('doctor_schedules', true);
    }

    public function down()
    {
        $this->forge->dropTable('doctor_schedules', true);
    }
}
