<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_transaksis')->insert([
            'nama' => 'Gaji',
            'jenis_transaksi_id' => 1,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'Tunjangan',
            'jenis_transaksi_id' => 1,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'investasi',
            'jenis_transaksi_id' => 1,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'Pensiun',
            'jenis_transaksi_id' => 1,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'Bisnis',
            'jenis_transaksi_id' => 4,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'Pekerjaan Sampingan',
            'jenis_transaksi_id' => 4,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'Bisnis',
            'jenis_transaksi_id' => 4,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'Investasi',
            'jenis_transaksi_id' => 4,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'Uang Makan',
            'jenis_transaksi_id' => 2,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'Transportasi',
            'jenis_transaksi_id' => 2,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'Tagihan (Listrik, Air, Telepon, Internet, dll)',
            'jenis_transaksi_id' => 2,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'Sewa atau KPR',
            'jenis_transaksi_id' => 2,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'Asuransi',
            'jenis_transaksi_id' => 2,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'Kesehatan',
            'jenis_transaksi_id' => 2,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'Pendidikan',
            'jenis_transaksi_id' => 2,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'Belanja',
            'jenis_transaksi_id' => 5,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'Hiburan',
            'jenis_transaksi_id' => 5,
            'user_id' => 0,
            'default' => 1
        ]);

        DB::table('kategori_transaksis')->insert([
            'nama' => 'Kebutuhan Lainnya (Olahraga, Hobi, Donasi, dll)',
            'jenis_transaksi_id' => 5,
            'user_id' => 0,
            'default' => 1
        ]);
    }
}
