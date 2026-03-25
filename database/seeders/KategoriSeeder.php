<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama' => 'Berita Utama', 'warna' => '#1B3B6F'],
            ['nama' => 'Pemerintahan', 'warna' => '#C8960C'],
            ['nama' => 'Pembangunan', 'warna' => '#28a745'],
            ['nama' => 'Sosial', 'warna' => '#dc3545'],
            ['nama' => 'Ekonomi', 'warna' => '#17a2b8'],
            ['nama' => 'Pendidikan', 'warna' => '#6f42c1'],
            ['nama' => 'Kesehatan', 'warna' => '#fd7e14'],
            ['nama' => 'Pariwisata', 'warna' => '#20c997'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
