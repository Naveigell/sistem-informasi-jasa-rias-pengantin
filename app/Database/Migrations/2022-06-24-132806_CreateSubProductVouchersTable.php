<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubProductVouchersTable extends Migration
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
            'code' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'amount' => [
                'type' => 'INT',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sub_product_id', 'sub_products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('sub_product_vouchers');
    }

    public function down()
    {
        $this->forge->dropTable('sub_product_vouchers');
    }
}
