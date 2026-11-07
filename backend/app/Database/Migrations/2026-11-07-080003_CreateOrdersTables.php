<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrdersTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'code'          => ['type' => 'VARCHAR', 'constraint' => 20],
            'customer_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'phone'         => ['type' => 'VARCHAR', 'constraint' => 20],
            'address'       => ['type' => 'TEXT'],
            'note'          => ['type' => 'TEXT', 'null' => true],
            'total'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'status'        => ['type' => 'ENUM', 'constraint' => ['baru', 'diproses', 'diantar', 'selesai', 'batal'], 'default' => 'baru'],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('code');
        $this->forge->addKey('status');
        $this->forge->createTable('orders');

        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'order_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'menu_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'menu_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'price'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'qty'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'subtotal'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('order_id', 'orders', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('menu_id', 'menus', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('order_items');
    }

    public function down()
    {
        $this->forge->dropTable('order_items');
        $this->forge->dropTable('orders');
    }
}
