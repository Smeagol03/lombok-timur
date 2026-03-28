<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function superAdmin(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('Super Admin');
        });
    }

    public function adminKonten(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('Admin Konten');
        });
    }

    public function adminLayanan(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('Admin Layanan');
        });
    }

    public function operatorHarga(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('Operator Harga');
        });
    }

    public function adminMedia(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('Admin Media');
        });
    }
}
