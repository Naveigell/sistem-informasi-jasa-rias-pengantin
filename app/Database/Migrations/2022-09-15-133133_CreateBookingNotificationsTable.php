<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookingNotificationsTable extends Migration
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
            'booking_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'is_read' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('booking_id', 'bookings', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('booking_notifications');
    }

    public function down()
    {
        $this->forge->dropTable('booking_notifications');
    }
}
