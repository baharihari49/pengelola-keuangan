<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class rolePermision extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'super admin']);
        $permissions = [
            'lihat_transaksi',
            'tambah_transaksi',
            'ubah_transaksi',
            'hapus_transaksi',
            'cetak_transaksi',
            'lihat_kategori_transaksi',
            'tambah_kategori_transaksi',
            'ubah_kategori_transaksi',
            'hapus_kategori_transaksi',
            'lihat_anggaran',
            'tambah_anggaran',
            'ubah_anggaran',
            'hapus_anggaran',
            'lihat_supplier',
            'tambah_supplier',
            'ubah_supplier',
            'hapus_supplier',
            'lihat_pemasukan',
            'hapus_pemasukan',
            'cetak_pemasukan',
            'lihat_pengeluaran',
            'hapus_pengeluaran',
            'cetak_pengeluaran',
            'lihat_laba_rugi',
            'hapus_laba_rugi',
            'cetak_laba_rugi',
            'lihat_user',
            'tambah_user',
            'ubah_user',
            'hapus_user',
            'lihat_feedback',
            'hapus_feedback',
            'lihat_akses_level',
            'tambah_akses_level',
            'ubah_akses_level',
            'hapus_akses_level',
        ];

        $permission = Permission::create($permissions);

        $role->givePermissionTo($permission);
    }
}
