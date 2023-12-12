<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'password'    => '123',
            'created_at'    => date('Y-m-d H:i:s'),
            'created_by'    => 1,

        ];
        $this->db->table('users')->insert($data);
    }
}