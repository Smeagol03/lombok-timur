<?php

namespace App\Filament\Resources\HargaPokoks;

use App\Filament\Resources\HargaPokoks\Pages\CreateHargaPokok;
use App\Filament\Resources\HargaPokoks\Pages\EditHargaPokok;
use App\Filament\Resources\HargaPokoks\Pages\ListHargaPokoks;
use App\Filament\Resources\HargaPokoks\Schemas\HargaPokokForm;
use App\Filament\Resources\HargaPokoks\Tables\HargaPokoksTable;
use App\Models\HargaPokok;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class HargaPokokResource extends Resource
{
    protected static ?string $model = HargaPokok::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCurrencyDollar;

    protected static ?string $navigationLabel = 'Harga Pokok';

    protected static ?string $modelLabel = 'Harga Pokok';

    protected static ?string $pluralModelLabel = 'Harga Pokok';

    protected static UnitEnum|string|null $navigationGroup = 'Data';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return HargaPokokForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HargaPokoksTable::configure($table);
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
            'index' => ListHargaPokoks::route('/'),
            'create' => CreateHargaPokok::route('/create'),
            'edit' => EditHargaPokok::route('/{record}/edit'),
        ];
    }
}
