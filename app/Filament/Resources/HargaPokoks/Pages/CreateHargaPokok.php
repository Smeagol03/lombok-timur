<?php

namespace App\Filament\Resources\HargaPokoks\Pages;

use App\Filament\Resources\HargaPokoks\HargaPokokResource;
use App\Models\HargaPokok;
use Filament\Resources\Pages\CreateRecord;

/**
 * @extends CreateRecord<HargaPokok>
 */
class CreateHargaPokok extends CreateRecord
{
    protected static string $resource = HargaPokokResource::class;
}
