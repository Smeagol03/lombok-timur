<?php

namespace App\Filament\Resources\StokDarahs;

use App\Filament\Resources\StokDarahs\Pages\CreateStokDarah;
use App\Filament\Resources\StokDarahs\Pages\EditStokDarah;
use App\Filament\Resources\StokDarahs\Pages\ListStokDarahs;
use App\Filament\Resources\StokDarahs\Schemas\StokDarahForm;
use App\Filament\Resources\StokDarahs\Tables\StokDarahsTable;
use App\Models\StokDarah;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StokDarahResource extends Resource
{
    protected static ?string $model = StokDarah::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return StokDarahForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StokDarahsTable::configure($table);
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
            'index' => ListStokDarahs::route('/'),
            'create' => CreateStokDarah::route('/create'),
            'edit' => EditStokDarah::route('/{record}/edit'),
        ];
    }
}
