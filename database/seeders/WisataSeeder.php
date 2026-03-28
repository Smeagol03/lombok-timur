<?php

namespace Database\Seeders;

use App\Models\Wisata;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WisataSeeder extends Seeder
{
    public function run(): void
    {
        $wisatas = [
            [
                'nama' => 'Pantai Tanjung Luar',
                'deskripsi' => '<p>Pantai Tanjung Luar adalah destinasi wisata pantai yang terletak di Kecamatan Keruak, Lombok Timur. Pantai ini menawarkan keindahan pasir putih dengan ombak yang tenang, cocok untuk berenang dan snorkeling.</p><p>Pengunjung dapat menikmati aktivitas seperti diving, snorkeling, dan memancing. Terdapat juga warung makan yang menyajikan hidangan laut segar.</p>',
                'kecamatan' => 'Keruak',
                'lokasi' => 'Desa Tanjung Luar, Kecamatan Keruak',
                'koordinat_lat' => -8.7845,
                'koordinat_lng' => 116.5432,
            ],
            [
                'nama' => 'Gunung Rinjani',
                'deskripsi' => '<p>Gunung Rinjani adalah gunung berapi aktif dan merupakan gunung tertinggi kedua di Indonesia dengan ketinggian 3.726 mdpl. Terletak di Kecamatan Sembalun, Lombok Timur.</p><p>Pendakian gunung Rinjani menawarkan pemandangan Danau Segara Anak yang indah dan kawah gunung berapi yang masih aktif. Trekking dimulai dari Desa Sembalun Lawang.</p>',
                'kecamatan' => 'Sembalun',
                'lokasi' => 'Desa Sembalun Lawang, Kecamatan Sembalun',
                'koordinat_lat' => -8.4095,
                'koordinat_lng' => 116.4572,
            ],
            [
                'nama' => 'Air Terjun Benang Kelambu',
                'deskripsi' => '<p>Air Terjun Benang Kelambu adalah air terjun yang terletak di Kecamatan Sembalun dengan ketinggian sekitar 40 meter. Keunikan air terjun ini terletak pada bentuknya yang menyerupai kelambu.</p><p>Air terjun ini dikelilingi oleh pegunungan yang hijau dan udara yang sejuk. Cocok untuk refreshing dan menikmati alam.</p>',
                'kecamatan' => 'Sembalun',
                'lokasi' => 'Desa Sajang, Kecamatan Sembalun',
                'koordinat_lat' => -8.4123,
                'koordinat_lng' => 116.4890,
            ],
            [
                'nama' => 'Desa Sade',
                'deskripsi' => '<p>Desa Sade adalah desa adat Sasak yang terletak di Kecamatan Pujut. Desa ini menawarkan pengalaman budaya asli Suku Sasak dengan rumah-rumah tradisional yang masih terjaga.</p><p>Pengunjung dapat melihat proses pembuatan kain tenun tradisional, kerajinan tangan, dan mencoba makanan khas Sasak.</p>',
                'kecamatan' => 'Pujut',
                'lokasi' => 'Desa Sade, Kecamatan Pujut',
                'koordinat_lat' => -8.8567,
                'koordinat_lng' => 116.2890,
            ],
            [
                'nama' => 'Gili Kondo',
                'deskripsi' => '<p>Gili Kondo adalah pulau kecil yang terletak di lepas pantai Lombok Timur. Pulau ini menawarkan pantai yang belum banyak tersentuh dengan air laut yang jernih dan biota laut yang beragam.</p><p>Aktivitas populer di Gili Kondo adalah snorkeling, diving, dan berkemah. Pulau ini masih sepi dan cocok untuk yang menyukai ketenangan.</p>',
                'kecamatan' => 'Sambelia',
                'lokasi' => 'Pulau Gili Kondo, Kecamatan Sambelia',
                'koordinat_lat' => -8.4567,
                'koordinat_lng' => 116.6789,
            ],
            [
                'nama' => 'Pantai Surga',
                'deskripsi' => '<p>Pantai Surga adalah pantai tersembunyi yang terletak di Kecamatan Jerowaru. Pantai ini menawarkan keindahan pasir putih bersih dengan air kristal yang jernih.</p><p>Nama "Surga" diberikan karena keindahan pantai yang menyerupai surga. Cocok untuk berenang, berjemur, dan menikmati sunset.</p>',
                'kecamatan' => 'Jerowaru',
                'lokasi' => 'Desa Pemoto, Kecamatan Jerowaru',
                'koordinat_lat' => -8.9234,
                'koordinat_lng' => 116.5678,
            ],
        ];

        foreach ($wisatas as $wisataData) {
            $wisata = Wisata::create([
                'nama' => $wisataData['nama'],
                'slug' => Str::slug($wisataData['nama']),
                'deskripsi' => $wisataData['deskripsi'],
                'kecamatan' => $wisataData['kecamatan'],
                'lokasi' => $wisataData['lokasi'],
                'koordinat_lat' => $wisataData['koordinat_lat'],
                'koordinat_lng' => $wisataData['koordinat_lng'],
            ]);

            // Attach main image
            try {
                $wisata->addMediaFromUrl("https://picsum.photos/800/600?random={$wisata->id}")
                    ->toMediaCollection('foto_utama');

                // Attach gallery images (2-3 images)
                for ($i = 1; $i <= 3; $i++) {
                    $wisata->addMediaFromUrl("https://picsum.photos/800/600?random={$wisata->id}_{$i}")
                        ->toMediaCollection('galeri');
                }
            } catch (\Exception $e) {
                $this->command->warn("Could not download image for '{$wisata->nama}': {$e->getMessage()}");
            }
        }

        $this->command->info('Wisata seeded successfully with images.');
    }
}
