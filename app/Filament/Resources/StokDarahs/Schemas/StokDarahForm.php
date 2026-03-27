<?php

namespace App\Filament\Resources\StokDarahs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StokDarahForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('golongan')
                    ->label('Golongan Darah')
                    ->required()
                    ->options([
                        'A' => 'Golongan A',
                        'B' => 'Golongan B',
                        'AB' => 'Golongan AB',
                        'O' => 'Golongan O',
                    ])
                    ->columnSpanFull(),
                TextInput::make('jumlah')
                    ->label('Jumlah (Kantong)')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->columnSpanFull(),
                DatePicker::make('tanggal_update')
                    ->label('Tanggal Update')
                    ->required()
                    ->default(now())
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->columnSpanFull(),
            ]);
    }
}
