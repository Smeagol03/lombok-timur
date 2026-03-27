<?php

namespace App\Filament\Resources\Pengumumen\Pages;

use App\Filament\Resources\Pengumumen\PengumumanResource;
use App\Models\Pengumuman;
use Filament\Resources\Pages\CreateRecord;

/**
 * @extends CreateRecord<Pengumuman>
 */
class CreatePengumuman extends CreateRecord
{
    protected static string $resource = PengumumanResource::class;
}
