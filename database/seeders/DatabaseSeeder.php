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
            UserSeeder::class,
            ScheduleSeeder::class,
            AbsensiGuruSeeder::class,
            AbsensiSiswaSeeder::class,
        ]);
    }
}
