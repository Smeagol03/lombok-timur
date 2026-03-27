<?php

namespace App\Filament\Resources\Kategoris\Pages;

use App\Filament\Resources\Kategoris\KategoriResource;
use App\Models\Kategori;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

/**
 * @extends EditRecord<Kategori>
 */
class EditKategori extends EditRecord
{
    protected static string $resource = KategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
