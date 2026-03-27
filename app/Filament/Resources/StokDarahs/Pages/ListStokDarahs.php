<?php

namespace App\Filament\Resources\StokDarahs\Pages;

use App\Filament\Resources\StokDarahs\StokDarahResource;
use App\Models\StokDarah;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

/**
 * @extends ListRecords<StokDarah>
 */
class ListStokDarahs extends ListRecords
{
    protected static string $resource = StokDarahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
