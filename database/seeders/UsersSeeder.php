<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'username' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('admin12345'),
            'email_verified_at' => '2023-12-10 13:43:34',
            'payment_id' => 1,
        ]);
    }
}
