<?php

namespace Database\Seeders;

use App\Models\HargaPokok;
use Illuminate\Database\Seeder;

class HargaPokokSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = [
            ['nama_komoditi' => 'Beras Premium', 'satuan' => 'Kg'],
            ['nama_komoditi' => 'Beras Medium', 'satuan' => 'Kg'],
            ['nama_komoditi' => 'Minyak Goreng', 'satuan' => 'Liter'],
            ['nama_komoditi' => 'Gula Pasir', 'satuan' => 'Kg'],
            ['nama_komoditi' => 'Telur Ayam', 'satuan' => 'Kg'],
            ['nama_komoditi' => 'Daging Ayam', 'satuan' => 'Kg'],
            ['nama_komoditi' => 'Daging Sapi', 'satuan' => 'Kg'],
            ['nama_komoditi' => 'Cabe Merah', 'satuan' => 'Kg'],
            ['nama_komoditi' => 'Bawang Merah', 'satuan' => 'Kg'],
            ['nama_komoditi' => 'Bawang Putih', 'satuan' => 'Kg'],
        ];

        foreach ($barangs as $barang) {
            $priceRanges = [
                'Beras Premium' => [12000, 15000],
                'Beras Medium' => [10000, 13000],
                'Minyak Goreng' => [16000, 20000],
                'Gula Pasir' => [14000, 17000],
                'Telur Ayam' => [25000, 32000],
                'Daging Ayam' => [32000, 38000],
                'Daging Sapi' => [140000, 160000],
                'Cabe Merah' => [25000, 45000],
                'Bawang Merah' => [20000, 30000],
                'Bawang Putih' => [28000, 38000],
            ];

            $range = $priceRanges[$barang['nama_komoditi']] ?? [10000, 15000];
            $price = rand($range[0], $range[1]);

            HargaPokok::create([
                'nama_komoditi' => $barang['nama_komoditi'],
                'satuan' => $barang['satuan'],
                'harga' => $price,
                'tanggal_update' => now(),
            ]);
        }

        $this->command->info('HargaPokok seeded successfully.');
    }
}
