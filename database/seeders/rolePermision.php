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
        $permision = Permission::create(
            ['name' => 'lihat transaksi'],
            ['name' => 'tambah transaksi'],
            ['name' => 'ubah transaksi'],
            ['name' => 'hapus transaksi'],
            ['name' => 'cetak transaksi'],
            ['name' => 'lihat kategori transaksi'],
            ['name' => 'tambah kategori transaksi'],
            ['name' => 'ubah kategori transaksi'],
            ['name' => 'hapus kategori transaksi'],
            ['name' => 'lihat anggaran'],
            ['name' => 'tambah anggaran'],
            ['name' => 'ubah anggaran'],
            ['name' => 'hapus anggaran'],
            ['name' => 'lihat supplier'],
            ['name' => 'tambah supplier'],
            ['name' => 'ubah supplier'],
            ['name' => 'hapus supplier'],
            ['name' => 'lihat pemasukan'],
            ['name' => 'hapus pemasukan'],
            ['name' => 'cetak pemasukan'],
            ['name' => 'lihat pengeluaran'],
            ['name' => 'hapus pengeluaran'],
            ['name' => 'cetak pengeluaran'],
            ['name' => 'lihat laba rugi'],
            ['name' => 'hapus laba rugi'],
            ['name' => 'cetak laba rugi'],
            ['name' => 'lihat user'],
            ['name' => 'tambah user'],
            ['name' => 'ubah user'],
            ['name' => 'hapus user'],
            ['name' => 'lihat feedback manage'],
            ['name' => 'hapus feedback manage'],
            ['name' => 'lihat akses level'],
            ['name' => 'tambah akses level'],
            ['name' => 'ubah akses level'],
            ['name' => 'hapus akses level']
        );

        $role->givePermissionTo($permision);
    }
}
