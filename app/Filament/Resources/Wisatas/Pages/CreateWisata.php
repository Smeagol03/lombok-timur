<?php

namespace App\Filament\Resources\Wisatas\Pages;

use App\Filament\Resources\Wisatas\WisataResource;
use App\Models\Wisata;
use Filament\Resources\Pages\CreateRecord;

/**
 * @extends CreateRecord<Wisata>
 */
class CreateWisata extends CreateRecord
{
    protected static string $resource = WisataResource::class;
}
