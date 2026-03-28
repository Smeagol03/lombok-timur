<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Illuminate\Support\HtmlString;

class Login extends BaseLogin
{
    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label(__('filament-panels::auth/pages/login.form.password.label'))
            ->hint(filament()->hasPasswordReset()
                ? new HtmlString('<a href="'.Filament::getRequestPasswordResetUrl().'" class="fi-link text-sm font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400" tabindex="-1"> Lupa Password? </a>')
                : null)
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->autocomplete('current-password')
            ->required();
    }
}
