<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            KategoriSeeder::class,
            LayananSeeder::class,
            StokDarahSeeder::class,
        ]);
    }
}
