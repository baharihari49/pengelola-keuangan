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
            UsersSeeder::class,
            addPermsission::class,
            addRole::class,
            addSubJenisTransaksi::class,
            addUserIdAtPayment::class,
            AnggaranSeeder::class,
            DashboardSeeder::class,
            FeedbackCenterSeeder::class,
            Jenis_transaksisSeeder::class,
            KategoriAnggaranSeeder::class,
            KategoriTransaksiSeeder::class,
            rolePermision::class,
            SUP_COS::class,
            TransaksiSeeder::class,
        ]);
    }
}
