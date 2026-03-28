<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            KategoriSeeder::class,
            LayananSeeder::class,
            StokDarahSeeder::class,
            BeritaSeeder::class,
            PengumumanSeeder::class,
            WisataSeeder::class,
            AgendaSeeder::class,
            SliderHeroSeeder::class,
            LinkBannerSeeder::class,
            HargaPokokSeeder::class,
        ]);
    }
}
