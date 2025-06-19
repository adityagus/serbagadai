<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->insert([
            'name' => 'kincat admin',
            'username' => 'kincat',
            'email' => 'kincat@gmail.com',
            'role'	=> \App\Util\Constant::USER_ROLE_ADMIN,
            'phone' => '123456',
            'password' => bcrypt('1234'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
