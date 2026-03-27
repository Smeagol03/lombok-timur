<?php

namespace App\Filament\Resources\SliderHeroes\Pages;

use App\Filament\Resources\SliderHeroes\SliderHeroResource;
use App\Models\SliderHero;
use Filament\Resources\Pages\CreateRecord;

/**
 * @extends CreateRecord<SliderHero>
 */
class CreateSliderHero extends CreateRecord
{
    protected static string $resource = SliderHeroResource::class;
}
