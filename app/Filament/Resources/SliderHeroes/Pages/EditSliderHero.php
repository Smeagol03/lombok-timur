<?php

namespace App\Filament\Resources\SliderHeroes\Pages;

use App\Filament\Resources\SliderHeroes\SliderHeroResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSliderHero extends EditRecord
{
    protected static string $resource = SliderHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
