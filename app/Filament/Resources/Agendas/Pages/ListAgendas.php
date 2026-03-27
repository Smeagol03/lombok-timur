<?php

namespace App\Filament\Resources\Agendas\Pages;

use App\Filament\Resources\Agendas\AgendaResource;
use App\Models\Agenda;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

/**
 * @extends ListRecords<Agenda>
 */
class ListAgendas extends ListRecords
{
    protected static string $resource = AgendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
