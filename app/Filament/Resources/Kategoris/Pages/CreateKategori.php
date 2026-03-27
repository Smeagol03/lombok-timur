<?php

namespace App\Filament\Resources\Kategoris\Pages;

use App\Filament\Resources\Kategoris\KategoriResource;
use App\Models\Kategori;
use Filament\Resources\Pages\CreateRecord;

/**
 * @extends CreateRecord<Kategori>
 */
class CreateKategori extends CreateRecord
{
    protected static string $resource = KategoriResource::class;
}
