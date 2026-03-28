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
                'is_active' => true,
            ],
            [
                'nama' => 'Akta Kelahiran',
                'deskripsi' => 'Pelayanan pembuatan akta kelahiran',
                'icon' => 'baby',
                'dinas_terkait' => 'Dinas Dukcapil',
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'nama' => 'Izin Usaha',
                'deskripsi' => 'Pelayanan perizinan berusaha',
                'icon' => 'briefcase',
                'dinas_terkait' => 'DPMPTSP',
                'urutan' => 3,
                'is_active' => true,
            ],
            [
                'nama' => 'Kesehatan',
                'deskripsi' => 'Pelayanan kesehatan masyarakat',
                'icon' => 'heart-pulse',
                'dinas_terkait' => 'Dinas Kesehatan',
                'urutan' => 4,
                'is_active' => true,
            ],
            [
                'nama' => 'Pendidikan',
                'deskripsi' => 'Informasi layanan pendidikan',
                'icon' => 'graduation-cap',
                'dinas_terkait' => 'Dinas Pendidikan',
                'urutan' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($layanans as $layananData) {
            Layanan::updateOrCreate(
                ['nama' => $layananData['nama']],
                $layananData
            );
        }

        $this->command->info('Layanan seeded successfully.');
    }
}
