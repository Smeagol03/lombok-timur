<?php

namespace App\Filament\Resources\Kategoris\Pages;

use App\Filament\Resources\Kategoris\KategoriResource;
use App\Models\Kategori;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

/**
 * @extends ListRecords<Kategori>
 */
class ListKategoris extends ListRecords
{
    protected static string $resource = KategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
