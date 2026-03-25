<?php

namespace App\Filament\Resources\StokDarahs\Pages;

use App\Filament\Resources\StokDarahs\StokDarahResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStokDarah extends EditRecord
{
    protected static string $resource = StokDarahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
