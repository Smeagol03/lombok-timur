<?php

namespace App\Filament\Resources\Agendas\Pages;

use App\Filament\Resources\Agendas\AgendaResource;
use App\Models\Agenda;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

/**
 * @extends EditRecord<Agenda>
 */
class EditAgenda extends EditRecord
{
    protected static string $resource = AgendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
