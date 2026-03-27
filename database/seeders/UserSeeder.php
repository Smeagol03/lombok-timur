<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin Portal',
            'email' => 'admin@lomboktimurkab.go.id',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('Super Admin');
    }
}
