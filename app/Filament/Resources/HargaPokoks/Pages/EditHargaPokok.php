<?php

namespace App\Filament\Resources\HargaPokoks\Pages;

use App\Filament\Resources\HargaPokoks\HargaPokokResource;
use App\Models\HargaPokok;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

/**
 * @extends EditRecord<HargaPokok>
 */
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
