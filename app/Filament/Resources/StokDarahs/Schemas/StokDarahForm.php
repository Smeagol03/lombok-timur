<?php

namespace App\Filament\Resources\StokDarahs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StokDarahForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('golongan')
                    ->required(),
                TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
                DatePicker::make('tanggal_update')
                    ->required(),
            ]);
    }
}
