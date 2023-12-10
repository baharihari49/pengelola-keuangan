<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Jenis_transaksisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_transaksis')->insert([
            'nama' => 'Pendapatan Tetap',
        ]);
        DB::table('jenis_transaksis')->insert([
            'nama' => 'Pengeluaran Pokok',
        ]);
        DB::table('jenis_transaksis')->insert([
            'nama' => 'Tabungan',
        ]);
        DB::table('jenis_transaksis')->insert([
            'nama' => 'Pendapatan Tidak Tetap',
        ]);
        DB::table('jenis_transaksis')->insert([
            'nama' => 'Pengeluaran Tambahan',
        ]);
    }
}
