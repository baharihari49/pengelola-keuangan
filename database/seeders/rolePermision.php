<?php

namespace Database\Seeders;

use App\Models\User;
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
        $permissions = [
            'lihat transaksi',
            'tambah transaksi',
            'ubah transaksi',
            'hapus transaksi',
            'cetak transaksi',
            'lihat kategori transaksi',
            'tambah kategori transaksi',
            'ubah kategori transaksi',
            'hapus kategori transaksi',
            'lihat anggaran',
            'tambah anggaran',
            'ubah anggaran',
            'hapus anggaran',
            'lihat supplier',
            'tambah supplier',
            'ubah supplier',
            'hapus supplier',

            'lihat pemasukan',
            'hapus pemasukan',
            'cetak pemasukan',

            'lihat pengeluaran',
            'hapus pengeluaran',
            'cetak pengeluaran',

            'lihat laba rugi',
            'hapus laba rugi',
            'cetak laba rugi',


            'lihat user',
            'tambah user',
            'ubah user',
            'hapus user',


            'lihat feedback',
            'hapus feedback',

            'lihat akses level',
            'tambah akses level',
            'ubah akses level',
            'hapus akses level',
        ];
        $role = Role::create(['name' => 'super admin']);
        $role->givePermissionTo($permissions);
        $user = User::where('username', 'Super Admin')->first();
        $user->assignRole('super admin');
    }
}
