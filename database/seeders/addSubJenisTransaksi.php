<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class addSubJenisTransaksi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_jenis_transaksi')->insert([
            'name' => 'Pendapatan Tetap',
            'jenis_transaksi_id' => 1,
        ]);
    }
}
