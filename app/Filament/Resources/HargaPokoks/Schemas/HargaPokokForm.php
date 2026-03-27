<?php

namespace App\Filament\Resources\HargaPokoks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HargaPokokForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Harga Pokok')
                    ->schema([
                        TextInput::make('nama_komoditi')
                            ->label('Nama Komoditi')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Beras IR 64')
                            ->columnSpanFull(),
                        TextInput::make('satuan')
                            ->label('Satuan')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('Contoh: Kg')
                            ->columnSpanFull(),
                        TextInput::make('harga')
                            ->label('Harga (Rp)')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->placeholder('Contoh: 15000')
                            ->columnSpanFull(),
                        DatePicker::make('tanggal_update')
                            ->label('Tanggal Update')
                            ->required()
                            ->default(now())
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }
}
