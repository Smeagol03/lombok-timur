<?php

namespace App\Filament\Resources\Wisatas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class WisataForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('deskripsi')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('lokasi')
                    ->required(),
                TextInput::make('kecamatan')
                    ->required(),
                TextInput::make('foto_utama'),
                TextInput::make('koordinat_lat')
                    ->numeric(),
                TextInput::make('koordinat_lng')
                    ->numeric(),
            ]);
    }
}
