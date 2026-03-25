<?php

namespace App\Filament\Resources\SliderHeroes;

use App\Filament\Resources\SliderHeroes\Pages\CreateSliderHero;
use App\Filament\Resources\SliderHeroes\Pages\EditSliderHero;
use App\Filament\Resources\SliderHeroes\Pages\ListSliderHeroes;
use App\Filament\Resources\SliderHeroes\Schemas\SliderHeroForm;
use App\Filament\Resources\SliderHeroes\Tables\SliderHeroesTable;
use App\Models\SliderHero;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SliderHeroResource extends Resource
{
    protected static ?string $model = SliderHero::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return SliderHeroForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SliderHeroesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSliderHeroes::route('/'),
            'create' => CreateSliderHero::route('/create'),
            'edit' => EditSliderHero::route('/{record}/edit'),
        ];
    }
}
