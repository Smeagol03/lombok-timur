<?php

namespace App\Filament\Resources\HargaPokoks\Pages;

use App\Filament\Resources\HargaPokoks\HargaPokokResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHargaPokok extends EditRecord
{
    protected static string $resource = HargaPokokResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
