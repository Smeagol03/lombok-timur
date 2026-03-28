<?php

namespace Database\Seeders;

use App\Models\Pengumuman;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        $pengumumans = [
            [
                'judul' => 'Libur Nasional Hari Raya Idul Fitri 1445 H',
                'konten' => '<p>Dengan ini diumumkan bahwa hari libur nasional Hari Raya Idul Fitri 1445 H jatuh pada tanggal yang akan ditentukan kemudian. Seluruh aparatur pemerintah dan masyarakat diharapkan dapat memanfaatkan waktu libur dengan baik.</p><p>Selamat merayakan Hari Raya Idul Fitri 1445 H. Mohon maaf lahir dan batin.</p>',
                'is_penting' => true,
                'tanggal_terbit' => now()->subDays(1),
            ],
            [
                'judul' => 'Pendaftaran CPNS Kabupaten Lombok Timur Tahun 2024',
                'konten' => '<p>Pendaftaran Calon Pegawai Negeri Sipil (CPNS) Kabupaten Lombok Timur Tahun 2024 dibuka mulai tanggal 1 April 2024. Pendaftaran dapat dilakukan secara online melalui website resmi BKN.</p><p>Persyaratan dan formasi yang tersedia dapat dilihat pada pengumuman resmi di website BKN. Pastikan melengkapi seluruh dokumen yang diperlukan sebelum mendaftar.</p>',
                'is_penting' => true,
                'tanggal_terbit' => now()->subDays(3),
            ],
            [
                'judul' => 'Jadwal Vaksinasi COVID-19 Bulan Ini',
                'konten' => '<p>Jadwal vaksinasi COVID-19 untuk bulan ini telah dirilis. Vaksinasi dilaksanakan di berbagai puskesmas dan posyandu di seluruh Kecamatan Lombok Timur.</p><p>Masyarakat yang belum vaksin diharapkan segera mendaftar melalui aplikasi atau datang langsung ke lokasi vaksinasi. Bawa identitas diri dan kartu vaksin sebelumnya (jika ada).</p>',
                'is_penting' => true,
                'tanggal_terbit' => now()->subDays(5),
            ],
            [
                'judul' => 'Pembayaran PBB Tahun 2024',
                'konten' => '<p>Pembayaran Pajak Bumi dan Bangunan (PBB) Tahun 2024 dapat dilakukan mulai bulan April hingga September 2024. Pembayaran dapat dilakukan di kantor pajak atau melalui bank yang ditunjuk.</p><p>Pembayaran sebelum tanggal 31 Mei mendapatkan potongan harga 10%. Segera lunasi kewajiban pajak Anda untuk menghindari denda keterlambatan.</p>',
                'is_penting' => false,
                'tanggal_terbit' => now()->subDays(7),
            ],
            [
                'judul' => 'Pengambilan KTP dan KK Baru',
                'konten' => '<p>Bagi warga yang telah mengajukan pembuatan KTP dan KK baru, pengambilan dapat dilakukan di kantor Desa/Kelurahan masing-masing. Bawa bukti pendaftaran dan identitas diri.</p><p>Untuk informasi lebih lanjut silakan hubungi kantor Kecamatan setempat.</p>',
                'is_penting' => false,
                'tanggal_terbit' => now()->subDays(10),
            ],
            [
                'judul' => 'Pendaftaran Bantuan Langsung Tunai (BLT)',
                'konten' => '<p>Program Bantuan Langsung Tunai (BLT) untuk masyarakat terdampak dibuka mulai bulan ini. Pendaftaran dapat dilakukan di kantor Desa/Kelurahan dengan membawa KTP dan KK.</p><p>Pastikan data yang didaftarkan sesuai dengan data di KTP dan KK.</p>',
                'is_penting' => false,
                'tanggal_terbit' => now()->subDays(14),
            ],
        ];

        foreach ($pengumumans as $pengumumanData) {
            $pengumuman = Pengumuman::create([
                'judul' => $pengumumanData['judul'],
                'slug' => Str::slug($pengumumanData['judul']),
                'konten' => $pengumumanData['konten'],
                'is_penting' => $pengumumanData['is_penting'],
                'tanggal_terbit' => $pengumumanData['tanggal_terbit'],
            ]);

            // Attach lampiran (image as sample attachment)
            try {
                $pengumuman->addMediaFromUrl("https://picsum.photos/1200/1600?random={$pengumuman->id}")
                    ->toMediaCollection('lampiran');
            } catch (\Exception $e) {
                $this->command->warn("Could not download lampiran for '{$pengumuman->judul}': {$e->getMessage()}");
            }
        }

        $this->command->info('Pengumuman seeded successfully.');
    }
}
