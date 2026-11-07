<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $email = env('ADMIN_EMAIL', 'umraithi769@gmail.com');

        if ($this->db->table('users')->where('email', $email)->countAllResults() > 0) {
            return;
        }

        $now = date('Y-m-d H:i:s');
        $this->db->table('users')->insert([
            'name'          => 'Ahmad Umraithi',
            'email'         => $email,
            // Password awal. Ganti lewat ADMIN_PASSWORD di file .env sebelum seeding.
            'password_hash' => password_hash(env('ADMIN_PASSWORD', 'burger123'), PASSWORD_DEFAULT),
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);
    }
}
