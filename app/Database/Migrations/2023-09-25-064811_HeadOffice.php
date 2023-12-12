<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HeadOffice extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'location' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'created_by' => [
                'type'           => 'BIGINT',
                'constraint'     => 30,
            ],
            'updated_by' => [
                'type'           => 'BIGINT',
                'constraint'     => 30,
                'null'           => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('head_office');
    }

    public function down()
    {
        $this->forge->dropTable('head_office');
    }
}