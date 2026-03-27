<?php

namespace App\Filament\Resources\Kategoris\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class KategoriForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(100)
                    ->live(onBlur: true)
                    ->debounce(500)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                    ->placeholder('Contoh: Politik')
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(100)
                    ->unique(ignoreRecord: true)
                    ->placeholder('Contoh: politik')
                    ->columnSpanFull(),
                ColorPicker::make('warna')
                    ->label('Warna Badge')
                    ->default('#6366f1')
                    ->helperText('Warna untuk badge kategori')
                    ->columnSpanFull(),
            ]);
    }
}
