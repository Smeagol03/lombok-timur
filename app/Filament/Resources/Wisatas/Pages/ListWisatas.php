<?php

namespace App\Filament\Resources\Wisatas\Pages;

use App\Filament\Resources\Wisatas\WisataResource;
use App\Models\Wisata;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

/**
 * @extends ListRecords<Wisata>
 */
class ListWisatas extends ListRecords
{
    protected static string $resource = WisataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
