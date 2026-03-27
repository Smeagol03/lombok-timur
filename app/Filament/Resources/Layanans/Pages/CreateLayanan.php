<?php

namespace App\Filament\Resources\Layanans\Pages;

use App\Filament\Resources\Layanans\LayananResource;
use App\Models\Layanan;
use Filament\Resources\Pages\CreateRecord;

/**
 * @extends CreateRecord<Layanan>
 */
class CreateLayanan extends CreateRecord
{
    protected static string $resource = LayananResource::class;
}
