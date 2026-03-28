<?php

namespace Database\Factories;

use App\Models\HargaPokok;
use Illuminate\Database\Eloquent\Factories\Factory;

class HargaPokokFactory extends Factory
{
    protected $model = HargaPokok::class;

    public function definition(): array
    {
        $komoditas = [
            // Beras & Gandum
            ['nama' => 'Beras Premium', 'satuan' => 'Kg', 'min' => 12000, 'max' => 15000],
            ['nama' => 'Beras Medium', 'satuan' => 'Kg', 'min' => 10000, 'max' => 13000],
            ['nama' => 'Beras Ketan', 'satuan' => 'Kg', 'min' => 13000, 'max' => 16000],
            ['nama' => 'Tepung Terigu', 'satuan' => 'Kg', 'min' => 11000, 'max' => 14000],
            ['nama' => 'Tepung Beras', 'satuan' => 'Kg', 'min' => 10000, 'max' => 13000],
            ['nama' => 'Tepung Tapioka', 'satuan' => 'Kg', 'min' => 12000, 'max' => 15000],

            // Mie & Olahan
            ['nama' => 'Mie Instan', 'satuan' => 'Bks', 'min' => 2800, 'max' => 3500],
            ['nama' => 'Mie Goreng', 'satuan' => 'Bks', 'min' => 3500, 'max' => 4500],
            ['nama' => 'Mie Kuah', 'satuan' => 'Bks', 'min' => 3000, 'max' => 4000],

            // gula & Pemanis
            ['nama' => 'Gula Pasir', 'satuan' => 'Kg', 'min' => 14000, 'max' => 17000],
            ['nama' => 'Gula Merah', 'satuan' => 'Kg', 'min' => 12000, 'max' => 15000],
            ['nama' => 'Gula Semut', 'satuan' => 'Kg', 'min' => 18000, 'max' => 22000],

            // Minyak
            ['nama' => 'Minyak Goreng', 'satuan' => 'Liter', 'min' => 16000, 'max' => 20000],
            ['nama' => 'Minyak Kelapa', 'satuan' => 'Liter', 'min' => 25000, 'max' => 32000],
            ['nama' => 'Minyak Zaitun', 'satuan' => 'Ml', 'min' => 35000, 'max' => 50000],
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
            ['nama' => 'Cabe Kering', 'satuan' => 'Kg', 'min' => 80000, 'max' => 120000],
            ['nama' => 'Bawang Merah', 'satuan' => 'Kg', 'min' => 20000, 'max' => 30000],
            ['nama' => 'Bawang Putih', 'satuan' => 'Kg', 'min' => 28000, 'max' => 38000],

            // Sayuran
            ['nama' => 'Wortel', 'satuan' => 'Kg', 'min' => 12000, 'max' => 18000],
            ['nama' => 'Kentang', 'satuan' => 'Kg', 'min' => 12000, 'max' => 16000],
            ['nama' => 'Tomat', 'satuan' => 'Kg', 'min' => 10000, 'max' => 18000],
            ['nama' => 'Brokoli', 'satuan' => 'Kg', 'min' => 20000, 'max' => 28000],
            ['nama' => 'Kembang Kol', 'satuan' => 'Kg', 'min' => 18000, 'max' => 25000],
            ['nama' => 'Petsai/Sawi', 'satuan' => 'Kg', 'min' => 8000, 'max' => 12000],
            ['nama' => 'Kangkung', 'satuan' => 'Kg', 'min' => 6000, 'max' => 10000],
            ['nama' => 'Bayam', 'satuan' => 'Kg', 'min' => 5000, 'max' => 8000],
            ['nama' => 'Timun', 'satuan' => 'Kg', 'min' => 8000, 'max' => 12000],
            ['nama' => 'Terong', 'satuan' => 'Kg', 'min' => 10000, 'max' => 15000],

            // Kacang-kacangan
            ['nama' => 'Kacang Kedelai', 'satuan' => 'Kg', 'min' => 12000, 'max' => 15000],
            ['nama' => 'Kacang Hijau', 'satuan' => 'Kg', 'min' => 22000, 'max' => 28000],
            ['nama' => 'Kacang Tanah', 'satuan' => 'Kg', 'min' => 25000, 'max' => 30000],
            ['nama' => 'Kacang Polong', 'satuan' => 'Kg', 'min' => 20000, 'max' => 25000],

            // Susu & Olahan
            ['nama' => 'Susu Kental Manis', 'satuan' => 'Kaleng', 'min' => 12000, 'max' => 15000],
            ['nama' => 'Susu Bubuk', 'satuan' => 'Bks', 'min' => 25000, 'max' => 40000],
            ['nama' => 'Susu UHT', 'satuan' => 'Liter', 'min' => 10000, 'max' => 15000],
            ['nama' => 'Yoghurt', 'satuan' => 'Bks', 'min' => 8000, 'max' => 12000],

            // Garam & Bumbu
            ['nama' => 'Garam Beryodium', 'satuan' => 'Bks', 'min' => 2000, 'max' => 4000],
            ['nama' => 'Garam Dapur', 'satuan' => 'Kg', 'min' => 8000, 'max' => 12000],
            ['nama' => 'Merica', 'satuan' => 'Kg', 'min' => 60000, 'max' => 90000],
            ['nama' => 'Ketumbar', 'satuan' => 'Kg', 'min' => 25000, 'max' => 35000],
            ['nama' => 'Bumbu Instan', 'satuan' => 'Bks', 'min' => 2000, 'max' => 4000],

            // Ikan
            ['nama' => 'Ikan Kembung', 'satuan' => 'Kg', 'min' => 35000, 'max' => 45000],
            ['nama' => 'Ikan Teri', 'satuan' => 'Kg', 'min' => 60000, 'max' => 90000],
            ['nama' => 'Ikan Tongkol', 'satuan' => 'Kg', 'min' => 40000, 'max' => 55000],
            ['nama' => 'Ikan Tuna', 'satuan' => 'Kg', 'min' => 50000, 'max' => 70000],
            ['nama' => 'Ikan Bandeng', 'satuan' => 'Kg', 'min' => 35000, 'max' => 45000],
            ['nama' => 'Ikan Salem', 'satuan' => 'Kg', 'min' => 30000, 'max' => 40000],
            ['nama' => 'Udang Segar', 'satuan' => 'Kg', 'min' => 60000, 'max' => 90000],
            ['nama' => 'Kepiting', 'satuan' => 'Kg', 'min' => 70000, 'max' => 100000],

            // Buah-buahan
            ['nama' => 'Pisang', 'satuan' => 'Kg', 'min' => 10000, 'max' => 18000],
            ['nama' => 'Jeruk', 'satuan' => 'Kg', 'min' => 15000, 'max' => 25000],
            ['nama' => 'Apel', 'satuan' => 'Kg', 'min' => 25000, 'max' => 40000],
            ['nama' => 'Mangga', 'satuan' => 'Kg', 'min' => 15000, 'max' => 25000],
            ['nama' => 'Pepaya', 'satuan' => 'Kg', 'min' => 8000, 'max' => 12000],
            ['nama' => 'Semangka', 'satuan' => 'Kg', 'min' => 8000, 'max' => 12000],
            ['nama' => 'Durian', 'satuan' => 'Kg', 'min' => 30000, 'max' => 50000],
            ['nama' => 'Rambutan', 'satuan' => 'Kg', 'min' => 15000, 'max' => 25000],
        ];

        $item = $this->faker->randomElement($komoditas);

        return [
            'nama_komoditi' => $item['nama'],
            'satuan' => $item['satuan'],
            'harga' => $this->faker->numberBetween($item['min'], $item['max']),
            'tanggal_update' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
