<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        $agendas = [
            [
                'judul' => 'Rapat Koordinasi Pembangunan Infrastruktur',
                'deskripsi' => 'Rapat koordinasi pembangunan infrastruktur tahun 2024 yang dihadiri oleh seluruh Kepala Desa dan Kepala Kecamatan.',
                'jenis' => 'bupati',
                'tanggal' => now()->addDays(2)->format('Y-m-d'),
                'jam_mulai' => '09:00',
                'jam_selesai' => '12:00',
                'lokasi' => 'Aula Kantor Bupati Lombok Timur',
            ],
            [
                'judul' => 'Pelatihan UMKM Digital Marketing',
                'deskripsi' => 'Pelatihan digital marketing untuk pelaku UMKM dalam rangka meningkatkan pemasaran online.',
                'jenis' => 'sekda',
                'tanggal' => now()->addDays(5)->format('Y-m-d'),
                'jam_mulai' => '08:00',
                'jam_selesai' => '16:00',
                'lokasi' => 'Gedung Dinas Koperasi dan UKM',
            ],
            [
                'judul' => 'Festival Budaya Lombok Timur 2024',
                'deskripsi' => 'Festival budaya tahunan yang menampilkan kesenian tradisional, kuliner, dan kerajinan khas Lombok Timur.',
                'jenis' => 'bupati',
                'tanggal' => now()->addDays(10)->format('Y-m-d'),
                'jam_mulai' => '10:00',
                'jam_selesai' => '22:00',
                'lokasi' => 'Alun-alun Sikur',
            ],
            [
                'judul' => 'Vaksinasi COVID-19 Massal',
                'deskripsi' => 'Program vaksinasi COVID-19 massal untuk seluruh masyarakat Lombok Timur.',
                'jenis' => 'wabup',
                'tanggal' => now()->addDays(3)->format('Y-m-d'),
                'jam_mulai' => '08:00',
                'jam_selesai' => '15:00',
                'lokasi' => 'Puskesmas Se-Kabupaten Lombok Timur',
            ],
            [
                'judul' => 'Musrenbang Kabupaten',
                'deskripsi' => 'Musyawarah Rencana Pembangunan Daerah untuk menyusun program prioritas tahun depan.',
                'jenis' => 'sekda',
                'tanggal' => now()->addDays(15)->format('Y-m-d'),
                'jam_mulai' => '09:00',
                'jam_selesai' => '17:00',
                'lokasi' => 'Gedung DPRD Lombok Timur',
            ],
        ];

        foreach ($agendas as $agenda) {
            Agenda::create($agenda);
        }

        $this->command->info('Agenda seeded successfully.');
    }
}
