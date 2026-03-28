<?php

namespace Database\Seeders;

use App\Models\LinkBanner;
use Illuminate\Database\Seeder;

class LinkBannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'nama' => 'Instagram Lombok Timur',
                'url_type' => 'external',
                'url' => '/',
                'url_external' => 'https://instagram.com/lomboktimurkab',
                'description' => 'Info terbaru & update kegiatan Pemkab Lombok Timur',
                'icon' => 'instagram',
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'nama' => 'Facebook Resmi',
                'url_type' => 'external',
                'url' => '/',
                'url_external' => 'https://facebook.com/lomboktimurkab',
                'description' => 'Berita & pengumuman resmi pemerintah daerah',
                'icon' => 'facebook',
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'nama' => 'YouTube Channel',
                'url_type' => 'external',
                'url' => '/',
                'url_external' => 'https://youtube.com/@lomboktimur',
                'description' => 'Video dokumenter, budaya, dan pariwisata',
                'icon' => 'youtube',
                'urutan' => 3,
                'is_active' => true,
            ],
            [
                'nama' => 'Berita Daerah',
                'url_type' => 'internal',
                'url' => '/berita',
                'url_external' => null,
                'description' => 'Kumpulan berita & artikel terkini',
                'icon' => 'news',
                'urutan' => 4,
                'is_active' => true,
            ],
            [
                'nama' => 'Destinasi Wisata',
                'url_type' => 'internal',
                'url' => '/wisata',
                'url_external' => null,
                'description' => 'Panduan wisata Lombok Timur lengkap',
                'icon' => 'maps',
                'urutan' => 5,
                'is_active' => true,
            ],
            [
                'nama' => 'Layanan Publik',
                'url_type' => 'internal',
                'url' => '/layanan',
                'url_external' => null,
                'description' => 'Akses layanan publik online',
                'icon' => 'website',
                'urutan' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $bannerData) {
            LinkBanner::create($bannerData);
        }

        $this->command->info('LinkBanner seeded successfully.');
    }
}
