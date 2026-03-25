<?php

namespace App\Filament\Resources\HargaPokoks\Pages;

use App\Filament\Resources\HargaPokoks\HargaPokokResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHargaPokoks extends ListRecords
{
    protected static string $resource = HargaPokokResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
