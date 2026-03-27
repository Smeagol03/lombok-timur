<?php

namespace App\Filament\Resources\Layanans\Pages;

use App\Filament\Resources\Layanans\LayananResource;
use App\Models\Layanan;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

/**
 * @extends ListRecords<Layanan>
 */
class ListLayanans extends ListRecords
{
    protected static string $resource = LayananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
