<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AdminCreateCommand extends Command
{
    protected $signature = 'admin:create
        {--name= : The name of the admin user}
        {--email= : The email address of the admin user}
        {--password= : The password for the admin user}
        {--role=Super Admin : The role to assign (Super Admin, Admin Konten, Admin Layanan, Operator Harga, Admin Media)}
        {--send-email : Send email verification notification}';

    protected $description = 'Create a new admin user';

    protected array $roles = [
        'Super Admin',
        'Admin Konten',
        'Admin Layanan',
        'Operator Harga',
        'Admin Media',
    ];

    public function handle(): int
    {
        $name = $this->option('name') ?? $this->ask('Nama admin');
        $email = $this->option('email') ?? $this->ask('Email admin');
        $password = $this->option('password') ?? $this->secret('Password admin');
        $role = $this->option('role');

        if (! in_array($role, $this->roles)) {
            $role = $this->choice('Pilih role', $this->roles, 0);
        }

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', Password::defaults()],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $user->assignRole($role);

        $this->info("Admin user '{$name}' created successfully!");
        $this->line("Email: {$email}");
        $this->line("Role: {$role}");

        if ($this->option('send-email')) {
            $user->sendEmailVerificationNotification();
            $this->info('Email verification sent.');
        }

        return self::SUCCESS;
    }
}
