<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class paymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payments')->insert([
            'id' => 1,
            'title' => 'Langganan Super Admin',
            'amount' => 999999,
            'status' => 'paid',
            'external_id' => 'infinite',
            'url' => 'https://octansidn.com',
            'user_id' => 1,
        ]);
    }
}
