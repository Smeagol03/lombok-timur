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
                'url_type' => 'internal',
                'url_link' => '/profil',
                'url_link_external' => null,
                'label_tombol' => 'Selengkapnya',
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'judul' => 'Destinasi Wisata Lombok Timur',
                'subtitle' => 'Keindahan Alam yang Memukau',
                'url_type' => 'internal',
                'url_link' => '/wisata',
                'url_link_external' => null,
                'label_tombol' => 'Lihat Wisata',
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'judul' => 'Layanan Publik Online',
                'subtitle' => 'Kemudahan Akses untuk Masyarakat',
                'url_type' => 'internal',
                'url_link' => '/layanan',
                'url_link_external' => null,
                'label_tombol' => 'Akses Layanan',
                'urutan' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sliders as $sliderData) {
            $slider = SliderHero::create([
                'judul' => $sliderData['judul'],
                'subtitle' => $sliderData['subtitle'],
                'url_type' => $sliderData['url_type'],
                'url_link' => $sliderData['url_link'],
                'url_link_external' => $sliderData['url_link_external'],
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
