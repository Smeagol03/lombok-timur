<?php

namespace App\Filament\Resources\Wisatas\Pages;

use App\Filament\Resources\Wisatas\WisataResource;
use App\Models\Wisata;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

/**
 * @extends EditRecord<Wisata>
 */
class EditWisata extends EditRecord
{
    protected static string $resource = WisataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
