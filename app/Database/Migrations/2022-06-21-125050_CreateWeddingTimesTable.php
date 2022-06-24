<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWeddingTimesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'wedding_time' => [
                'type' => 'TIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('wedding_times');
    }

    public function down()
    {
        $this->forge->dropTable('wedding_times');
    }
}
