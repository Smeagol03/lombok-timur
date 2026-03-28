<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::role('Super Admin')->first();

        if (! $admin) {
            $this->command->error('No Super Admin user found. Please run UserSeeder first.');

            return;
        }

        $kategoris = Kategori::all();

        if ($kategoris->isEmpty()) {
            $this->command->error('No categories found. Please run KategoriSeeder first.');

            return;
        }

        $beritas = [
            [
                'judul' => 'Bupati Lombok Timur Resmikan Jembatan Penghubung Desa',
                'excerpt' => 'Bupati Lombok Timur meresmikan jembatan penghubung desa yang dibangun untuk mempermudah akses masyarakat.',
                'kategori' => 'Pembangunan',
                'is_featured' => true,
                'days_ago' => 1,
            ],
            [
                'judul' => 'Program Beasiswa Pendidikan untuk Siswa Berprestasi',
                'excerpt' => 'Pemerintah Kabupaten Lombok Timur meluncurkan program beasiswa untuk siswa berprestasi dari keluarga kurang mampu.',
                'kategori' => 'Pendidikan',
                'is_featured' => true,
                'days_ago' => 2,
            ],
            [
                'judul' => 'Festival Budaya Lombok Timur Digelar Akhir Bulan Ini',
                'excerpt' => 'Festival budaya yang menampilkan kesenian tradisional dan kuliner khas Lombok Timur akan digelar akhir bulan ini.',
                'kategori' => 'Pariwisata',
                'is_featured' => false,
                'days_ago' => 3,
            ],
            [
                'judul' => 'Vaksinasi COVID-19 Tahap Kedua Dimulai',
                'excerpt' => 'Vaksinasi COVID-19 tahap kedua untuk masyarakat umum telah dimulai di berbagai puskesmas di Lombok Timur.',
                'kategori' => 'Kesehatan',
                'is_featured' => false,
                'days_ago' => 4,
            ],
            [
                'judul' => 'Pelatihan UMKM untuk Meningkatkan Ekonomi Desa',
                'excerpt' => 'Dinas Koperasi dan UKM menyelenggarakan pelatihan UMKM untuk meningkatkan kapasitas pelaku usaha di desa.',
                'kategori' => 'Ekonomi',
                'is_featured' => false,
                'days_ago' => 5,
            ],
        ];

        foreach ($beritas as $beritaData) {
            $kategori = $kategoris->firstWhere('nama', $beritaData['kategori']);

            if (! $kategori) {
                $this->command->warn("Category '{$beritaData['kategori']}' not found. Skipping '{$beritaData['judul']}'");

                continue;
            }

            $berita = Berita::create([
                'judul' => $beritaData['judul'],
                'slug' => Str::slug($beritaData['judul']),
                'excerpt' => $beritaData['excerpt'],
                'konten' => $this->generateKonten($beritaData['judul']),
                'kategori_id' => $kategori->id,
                'penulis_id' => $admin->id,
                'status' => 'published',
                'is_featured' => $beritaData['is_featured'],
                'published_at' => now()->subDays($beritaData['days_ago']),
            ]);

            // Attach image from picsum.photos
            try {
                $berita->addMediaFromUrl("https://picsum.photos/800/600?random={$berita->id}")
                    ->toMediaCollection('thumbnail');
            } catch (\Exception $e) {
                $this->command->warn("Could not download image for '{$berita->judul}': {$e->getMessage()}");
            }
        }

        $this->command->info('✓ Berita seeded successfully ('.count($beritas).' items).');
    }

    private function generateKonten(string $judul): string
    {
        return <<<HTML
            <p>Pemerintah Kabupaten Lombok Timur terus berkomitmen untuk meningkatkan pelayanan dan pembangunan di berbagai sektor. {$judul} merupakan bagian dari upaya tersebut.</p>
            <p>Kebijakan ini diharapkan dapat memberikan dampak positif bagi masyarakat dan mendukung pembangunan daerah yang berkelanjutan.</p>
            <p>Masyarakat dapat mengakses informasi lebih lanjut melalui kanal resmi Pemerintah Kabupaten Lombok Timur atau menghubungi kontak yang tersedia.</p>
        HTML;
    }
}
