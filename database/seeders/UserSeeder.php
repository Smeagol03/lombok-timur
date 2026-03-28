<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@lomboktimurkab.go.id'],
            [
                'name' => 'Admin Portal',
                'password' => Hash::make('password'),
            ]
        );

        if ($user->wasRecentlyCreated || ! $user->hasRole('Super Admin')) {
            $user->assignRole('Super Admin');
        }

        $this->command->info('User seeded successfully.');
    }
}
