<?php

namespace App\Filament\Resources\Beritas\Pages;

use App\Filament\Resources\Beritas\BeritaResource;
use App\Models\Berita;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

/**
 * @extends EditRecord<Berita>
 */
class EditBerita extends EditRecord
{
    protected static string $resource = BeritaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
