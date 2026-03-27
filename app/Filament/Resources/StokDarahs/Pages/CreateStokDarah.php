<?php

namespace App\Filament\Resources\StokDarahs\Pages;

use App\Filament\Resources\StokDarahs\StokDarahResource;
use App\Models\StokDarah;
use Filament\Resources\Pages\CreateRecord;

/**
 * @extends CreateRecord<StokDarah>
 */
class CreateStokDarah extends CreateRecord
{
    protected static string $resource = StokDarahResource::class;
}
