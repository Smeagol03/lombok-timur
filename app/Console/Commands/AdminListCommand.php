<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AdminListCommand extends Command
{
    protected $signature = 'admin:list
        {--role=* : Filter by role}
        {--verified : Only show verified users}
        {--unverified : Only show unverified users}';

    protected $description = 'List all admin users';

    public function handle(): int
    {
        $query = User::with('roles');

        if ($this->option('role')) {
            $query->whereHas('roles', function ($q) {
                $q->whereIn('name', (array) $this->option('role'));
            });
        }

        if ($this->option('verified')) {
            $query->whereNotNull('email_verified_at');
        }

        if ($this->option('unverified')) {
            $query->whereNull('email_verified_at');
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        if ($users->isEmpty()) {
            $this->info('No admin users found.');

            return self::SUCCESS;
        }

        $this->table(
            ['ID', 'Name', 'Email', 'Roles', 'Verified', 'Created'],
            $users->map(function (User $user) {
                return [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->roles->pluck('name')->join(', '),
                    $user->email_verified_at ? '✓' : '✗',
                    $user->created_at->format('Y-m-d H:i'),
                ];
            })->toArray()
        );

        $this->info("Total: {$users->count()} admin users");

        return self::SUCCESS;
    }
}
