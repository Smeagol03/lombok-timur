<?php

namespace Database\Seeders;

use App\Models\HargaPokok;
use Illuminate\Database\Seeder;

class HargaPokokSeeder extends Seeder
{
    public function run(): void
    {
        $komoditas = [
            // Beras & Gandum
            ['nama' => 'Beras Premium', 'satuan' => 'Kg', 'min' => 12000, 'max' => 15000],
            ['nama' => 'Beras Medium', 'satuan' => 'Kg', 'min' => 10000, 'max' => 13000],
            ['nama' => 'Beras Ketan', 'satuan' => 'Kg', 'min' => 13000, 'max' => 16000],
            ['nama' => 'Tepung Terigu', 'satuan' => 'Kg', 'min' => 11000, 'max' => 14000],
            ['nama' => 'Tepung Beras', 'satuan' => 'Kg', 'min' => 10000, 'max' => 13000],

            // Mie & Olahan
            ['nama' => 'Mie Instan', 'satuan' => 'Bks', 'min' => 2800, 'max' => 3500],
            ['nama' => 'Mie Goreng', 'satuan' => 'Bks', 'min' => 3500, 'max' => 4500],

            // Gula & Pemanis
            ['nama' => 'Gula Pasir', 'satuan' => 'Kg', 'min' => 14000, 'max' => 17000],
            ['nama' => 'Gula Merah', 'satuan' => 'Kg', 'min' => 12000, 'max' => 15000],

            // Minyak
            ['nama' => 'Minyak Goreng', 'satuan' => 'Liter', 'min' => 16000, 'max' => 20000],
            ['nama' => 'Minyak Kelapa', 'satuan' => 'Liter', 'min' => 25000, 'max' => 32000],
            ['nama' => 'Mentega', 'satuan' => 'Bks', 'min' => 8000, 'max' => 12000],

            // Telur
            ['nama' => 'Telur Ayam Ras', 'satuan' => 'Kg', 'min' => 25000, 'max' => 32000],
            ['nama' => 'Telur Ayam Kampung', 'satuan' => 'Kg', 'min' => 35000, 'max' => 45000],
            ['nama' => 'Telur Bebek', 'satuan' => 'Kg', 'min' => 30000, 'max' => 38000],

            // Daging
            ['nama' => 'Daging Ayam Ras', 'satuan' => 'Kg', 'min' => 32000, 'max' => 38000],
            ['nama' => 'Daging Ayam Kampung', 'satuan' => 'Kg', 'min' => 45000, 'max' => 55000],
            ['nama' => 'Daging Sapi', 'satuan' => 'Kg', 'min' => 140000, 'max' => 160000],
            ['nama' => 'Daging Kambing', 'satuan' => 'Kg', 'min' => 130000, 'max' => 150000],

            // Cabe & Bawang
            ['nama' => 'Cabe Merah', 'satuan' => 'Kg', 'min' => 25000, 'max' => 45000],
            ['nama' => 'Cabe Rawit', 'satuan' => 'Kg', 'min' => 30000, 'max' => 50000],
            ['nama' => 'Bawang Merah', 'satuan' => 'Kg', 'min' => 20000, 'max' => 30000],
            ['nama' => 'Bawang Putih', 'satuan' => 'Kg', 'min' => 28000, 'max' => 38000],

            // Sayuran
            ['nama' => 'Wortel', 'satuan' => 'Kg', 'min' => 12000, 'max' => 18000],
            ['nama' => 'Kentang', 'satuan' => 'Kg', 'min' => 12000, 'max' => 16000],
            ['nama' => 'Tomat', 'satuan' => 'Kg', 'min' => 10000, 'max' => 18000],
            ['nama' => 'Brokoli', 'satuan' => 'Kg', 'min' => 20000, 'max' => 28000],
            ['nama' => 'Kangkung', 'satuan' => 'Kg', 'min' => 6000, 'max' => 10000],
            ['nama' => 'Bayam', 'satuan' => 'Kg', 'min' => 5000, 'max' => 8000],
            ['nama' => 'Timun', 'satuan' => 'Kg', 'min' => 8000, 'max' => 12000],

            // Kacang-kacangan
            ['nama' => 'Kacang Kedelai', 'satuan' => 'Kg', 'min' => 12000, 'max' => 15000],
            ['nama' => 'Kacang Hijau', 'satuan' => 'Kg', 'min' => 22000, 'max' => 28000],
            ['nama' => 'Kacang Tanah', 'satuan' => 'Kg', 'min' => 25000, 'max' => 30000],

            // Susu & Olahan
            ['nama' => 'Susu Kental Manis', 'satuan' => 'Kaleng', 'min' => 12000, 'max' => 15000],
            ['nama' => 'Susu UHT', 'satuan' => 'Liter', 'min' => 10000, 'max' => 15000],
            ['nama' => 'Yoghurt', 'satuan' => 'Bks', 'min' => 8000, 'max' => 12000],

            // Garam & Bumbu
            ['nama' => 'Garam Beryodium', 'satuan' => 'Bks', 'min' => 2000, 'max' => 4000],
            ['nama' => 'Merica', 'satuan' => 'Kg', 'min' => 60000, 'max' => 90000],
            ['nama' => 'Bumbu Instan', 'satuan' => 'Bks', 'min' => 2000, 'max' => 4000],

            // Ikan
            ['nama' => 'Ikan Kembung', 'satuan' => 'Kg', 'min' => 35000, 'max' => 45000],
            ['nama' => 'Ikan Teri', 'satuan' => 'Kg', 'min' => 60000, 'max' => 90000],
            ['nama' => 'Ikan Tongkol', 'satuan' => 'Kg', 'min' => 40000, 'max' => 55000],
            ['nama' => 'Ikan Tuna', 'satuan' => 'Kg', 'min' => 50000, 'max' => 70000],
            ['nama' => 'Udang Segar', 'satuan' => 'Kg', 'min' => 60000, 'max' => 90000],

            // Buah-buahan
            ['nama' => 'Pisang', 'satuan' => 'Kg', 'min' => 10000, 'max' => 18000],
            ['nama' => 'Jeruk', 'satuan' => 'Kg', 'min' => 15000, 'max' => 25000],
            ['nama' => 'Apel', 'satuan' => 'Kg', 'min' => 25000, 'max' => 40000],
            ['nama' => 'Mangga', 'satuan' => 'Kg', 'min' => 15000, 'max' => 25000],
            ['nama' => 'Pepaya', 'satuan' => 'Kg', 'min' => 8000, 'max' => 12000],
            ['nama' => 'Semangka', 'satuan' => 'Kg', 'min' => 8000, 'max' => 12000],
            ['nama' => 'Durian', 'satuan' => 'Kg', 'min' => 30000, 'max' => 50000],
        ];

        $komoditasCount = count($komoditas);
        $totalCreated = 0;

        // Create 3 historical records per commodity for price changes
        foreach ($komoditas as $item) {
            $basePrice = fake()->numberBetween($item['min'], $item['max']);
            
            // Record 1 - Oldest (3 weeks ago)
            HargaPokok::create([
                'nama_komoditi' => $item['nama'],
                'satuan' => $item['satuan'],
                'harga' => $basePrice,
                'tanggal_update' => now()->copy()->subWeeks(3),
            ]);
            $totalCreated++;

            // Record 2 - Middle (2 weeks ago) - slightly different price
            $priceChange = fake()->randomElement([-500, -300, 0, 300, 500]);
            HargaPokok::create([
                'nama_komoditi' => $item['nama'],
                'satuan' => $item['satuan'],
                'harga' => $basePrice + $priceChange,
                'tanggal_update' => now()->copy()->subWeeks(2),
            ]);
            $totalCreated++;

            // Record 3 - Latest (1 week ago) - another price change
            $priceChange2 = fake()->randomElement([-700, -400, -200, 200, 400, 700]);
            HargaPokok::create([
                'nama_komoditi' => $item['nama'],
                'satuan' => $item['satuan'],
                'harga' => $basePrice + $priceChange + $priceChange2,
                'tanggal_update' => now()->copy()->subWeek(),
            ]);
            $totalCreated++;
        }

        $this->command->info("HargaPokok seeded successfully. ({$totalCreated} items - {$komoditasCount} commodities with 3 historical records each)");
    }
}
