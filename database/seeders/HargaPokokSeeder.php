<?php

namespace Database\Seeders;

use Database\Factories\HargaPokokFactory;
use Illuminate\Database\Seeder;

class HargaPokokSeeder extends Seeder
{
    public function run(): void
    {
        HargaPokokFactory::new()->count(30)->create();

        $this->command->info('HargaPokok seeded successfully. (30 items)');
    }
}
