<?php

namespace Database\Seeders;

use App\Models\SliderHero;
use Illuminate\Database\Seeder;

class SliderHeroSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'judul' => 'Selamat Datang di Portal Lombok Timur',
                'subtitle' => 'Melayani dengan Transparan dan Profesional',
                'gambar' => 'sliders/hero-1.jpg',
                'url_link' => '/profil',
                'label_tombol' => 'Selengkapnya',
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'judul' => 'Destinasi Wisata Lombok Timur',
                'subtitle' => 'Keindahan Alam yang Memukau',
                'gambar' => 'sliders/hero-2.jpg',
                'url_link' => '/wisata',
                'label_tombol' => 'Lihat Wisata',
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'judul' => 'Layanan Publik Online',
                'subtitle' => 'Kemudahan Akses untuk Masyarakat',
                'gambar' => 'sliders/hero-3.jpg',
                'url_link' => '/layanan',
                'label_tombol' => 'Akses Layanan',
                'urutan' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sliders as $sliderData) {
            $slider = SliderHero::create([
                'judul' => $sliderData['judul'],
                'subtitle' => $sliderData['subtitle'],
                'url_link' => $sliderData['url_link'],
                'label_tombol' => $sliderData['label_tombol'],
                'urutan' => $sliderData['urutan'],
                'is_active' => $sliderData['is_active'],
            ]);

            // Attach image from picsum.photos
            try {
                $slider
                    ->addMediaFromUrl(
                        "https://picsum.photos/1920/600?random={$slider->id}",
                    )
                    ->toMediaCollection('gambar');
            } catch (\Exception $e) {
                $this->command->warn(
                    "Could not download image for slider '{$slider->judul}': {$e->getMessage()}",
                );
            }
        }

        $this->command->info('SliderHero seeded successfully with images.');
    }
}
