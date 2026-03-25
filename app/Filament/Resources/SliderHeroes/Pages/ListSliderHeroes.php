<?php

namespace App\Filament\Resources\SliderHeroes\Pages;

use App\Filament\Resources\SliderHeroes\SliderHeroResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSliderHeroes extends ListRecords
{
    protected static string $resource = SliderHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
