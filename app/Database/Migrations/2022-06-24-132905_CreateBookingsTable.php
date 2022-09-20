<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookingsTable extends Migration
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
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'product_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'sub_product_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'identity_card' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'wedding_date' => [
                'type' => 'DATETIME',
            ],
            'wedding_time_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'pre_wedding_date' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'payment_status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'is_expired' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 0,
            ],
            'expired_at' => [
                'type' => 'DATETIME',
            ],
            'is_finish' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 0,
            ],
            'voucher_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sub_product_id', 'sub_products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('wedding_time_id', 'wedding_times', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('voucher_id', 'sub_product_vouchers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bookings');
    }

    public function down()
    {
        $this->forge->dropTable('bookings');
    }
}
