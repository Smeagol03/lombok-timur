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
                'icon' => 'heroicon-o-identification',
                'dinas_terkait' => 'Dinas Dukcapil',
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'nama' => 'Akta Kelahiran',
                'deskripsi' => 'Pelayanan pembuatan akta kelahiran',
                'icon' => 'heroicon-o-user',
                'dinas_terkait' => 'Dinas Dukcapil',
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'nama' => 'Izin Usaha',
                'deskripsi' => 'Pelayanan perizinan berusaha',
                'icon' => 'heroicon-o-briefcase',
                'dinas_terkait' => 'DPMPTSP',
                'urutan' => 3,
                'is_active' => true,
            ],
            [
                'nama' => 'Kesehatan',
                'deskripsi' => 'Pelayanan kesehatan masyarakat',
                'icon' => 'heroicon-o-heart',
                'dinas_terkait' => 'Dinas Kesehatan',
                'urutan' => 4,
                'is_active' => true,
            ],
            [
                'nama' => 'Pendidikan',
                'deskripsi' => 'Informasi layanan pendidikan',
                'icon' => 'heroicon-o-academic-cap',
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
