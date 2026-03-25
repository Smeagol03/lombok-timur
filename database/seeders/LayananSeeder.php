<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $layanans = [
            [
                'nama' => 'E-KTP',
                'deskripsi' => 'Pelayanan pembuatan dan pengurusan KTP elektronik',
                'icon' => 'id-card',
                'dinas_terkait' => 'Dinas Dukcapil',
                'urutan' => 1,
            ],
            [
                'nama' => 'Akta Kelahiran',
                'deskripsi' => 'Pelayanan pembuatan akta kelahiran',
                'icon' => 'baby',
                'dinas_terkait' => 'Dinas Dukcapil',
                'urutan' => 2,
            ],
            [
                'nama' => 'Izin Usaha',
                'deskripsi' => 'Pelayanan perizinan berusaha',
                'icon' => 'briefcase',
                'dinas_terkait' => 'DPMPTSP',
                'urutan' => 3,
            ],
            [
                'nama' => 'Kesehatan',
                'deskripsi' => 'Pelayanan kesehatan masyarakat',
                'icon' => 'heart-pulse',
                'dinas_terkait' => 'Dinas Kesehatan',
                'urutan' => 4,
            ],
            [
                'nama' => 'Pendidikan',
                'deskripsi' => 'Informasi layanan pendidikan',
                'icon' => 'graduation-cap',
                'dinas_terkait' => 'Dinas Pendidikan',
                'urutan' => 5,
            ],
        ];

        foreach ($layanans as $layanan) {
            Layanan::create($layanan);
        }
    }
}
