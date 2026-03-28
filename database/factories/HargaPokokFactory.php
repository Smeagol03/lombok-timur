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
            ['nama' => 'Beras Premium', 'satuan' => 'Kg', 'min' => 12000, 'max' => 15000],
            ['nama' => 'Beras Medium', 'satuan' => 'Kg', 'min' => 10000, 'max' => 13000],
            ['nama' => 'Minyak Goreng', 'satuan' => 'Liter', 'min' => 16000, 'max' => 20000],
            ['nama' => 'Gula Pasir', 'satuan' => 'Kg', 'min' => 14000, 'max' => 17000],
            ['nama' => 'Telur Ayam', 'satuan' => 'Kg', 'min' => 25000, 'max' => 32000],
            ['nama' => 'Daging Ayam', 'satuan' => 'Kg', 'min' => 32000, 'max' => 38000],
            ['nama' => 'Daging Sapi', 'satuan' => 'Kg', 'min' => 140000, 'max' => 160000],
            ['nama' => 'Cabe Merah', 'satuan' => 'Kg', 'min' => 25000, 'max' => 45000],
            ['nama' => 'Bawang Merah', 'satuan' => 'Kg', 'min' => 20000, 'max' => 30000],
            ['nama' => 'Bawang Putih', 'satuan' => 'Kg', 'min' => 28000, 'max' => 38000],
            ['nama' => 'Tepung Terigu', 'satuan' => 'Kg', 'min' => 11000, 'max' => 14000],
            ['nama' => 'Garam Beryodium', 'satuan' => 'Bks', 'min' => 2000, 'max' => 4000],
            ['nama' => 'Susu Kental Manis', 'satuan' => 'Kaleng', 'min' => 12000, 'max' => 15000],
            ['nama' => 'Kacang Kedelai', 'satuan' => 'Kg', 'min' => 12000, 'max' => 15000],
            ['nama' => 'Kacang Hijau', 'satuan' => 'Kg', 'min' => 22000, 'max' => 28000],
            ['nama' => 'Kacang Tanah', 'satuan' => 'Kg', 'min' => 25000, 'max' => 30000],
            ['nama' => 'Ikan Kembung', 'satuan' => 'Kg', 'min' => 35000, 'max' => 45000],
            ['nama' => 'Ikan Teri', 'satuan' => 'Kg', 'min' => 60000, 'max' => 90000],
            ['nama' => 'Mie Instan', 'satuan' => 'Bks', 'min' => 2800, 'max' => 3500],
            ['nama' => 'Mentega', 'satuan' => 'Bks', 'min' => 8000, 'max' => 12000],
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
