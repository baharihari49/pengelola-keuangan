<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            Jenis_transaksisSeeder::class,
            KategoriTransaksiSeeder::class,
            SUP_COS::class,
            rolePermision::class,
            addPermsission::class,
            addRole::class,
        ]);
    }
}
