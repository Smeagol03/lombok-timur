<?php

namespace Database\Seeders;

use App\Models\StokDarah;
use Illuminate\Database\Seeder;

class StokDarahSeeder extends Seeder
{
    public function run(): void
    {
        $golongans = ['A', 'B', 'AB', 'O'];

        foreach ($golongans as $golongan) {
            StokDarah::updateOrCreate(
                ['golongan' => $golongan],
                [
                    'jumlah' => rand(50, 150),
                    'tanggal_update' => now(),
                ]
            );
        }

        $this->command->info('StokDarah seeded successfully.');
    }
}
