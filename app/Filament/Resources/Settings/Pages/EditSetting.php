<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingResource;
use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    protected static ?string $navigationLabel = 'Pengaturan';

    protected static ?string $title = 'Pengaturan Website';

    public function mount(int|string|null $record = null): void
    {
        $this->record = Setting::getInstance();

        $this->fillForm();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('reset')
                ->label('Reset ke Default')
                ->icon('heroicon-m-arrow-path')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Reset Pengaturan?')
                ->modalDescription('Semua pengaturan akan dikembalikan ke nilai default. Logo dan favicon juga akan dihapus.')
                ->modalSubmitActionLabel('Ya, Reset')
                ->action(function () {
                    $setting = Setting::getInstance();
                    $setting->clearMediaCollection('logo');
                    $setting->clearMediaCollection('favicon');
                    $setting->update([
                        'site_name' => 'Portal Lombok Timur',
                        'site_tagline' => 'Melayani dengan transparansi dan profesionalisme',
                        'site_description' => null,
                        'contact_phone' => null,
                        'contact_email' => null,
                        'contact_address' => null,
                        'social_facebook' => null,
                        'social_instagram' => null,
                        'social_twitter' => null,
                        'social_youtube' => null,
                    ]);
                    $this->redirect(EditSetting::getUrl());
                }),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Pengaturan berhasil disimpan';
    }
}
