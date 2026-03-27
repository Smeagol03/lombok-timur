<?php

namespace App\Filament\Resources\SliderHeroes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SliderHeroForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Selamat Datang')
                    ->columnSpanFull(),
                TextInput::make('subtitle')
                    ->label('Subtitle')
                    ->maxLength(500)
                    ->placeholder('Portal Resmi Pemerintah')
                    ->columnSpanFull(),
                FileUpload::make('gambar')
                    ->label('Gambar')
                    ->image()
                    ->imageEditor()
                    ->directory('slider')
                    ->visibility('public')
                    ->maxSize(5120)
                    ->helperText('Max 5MB. Resolusi: 1920x600px')
                    ->columnSpanFull(),
                TextInput::make('url_link')
                    ->label('URL Link')
                    ->url()
                    ->placeholder('https://...')
                    ->columnSpanFull(),
                TextInput::make('label_tombol')
                    ->label('Label Tombol')
                    ->maxLength(50)
                    ->placeholder('Selengkapnya')
                    ->columnSpanFull(),
                TextInput::make('urutan')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->columnSpanFull(),
            ]);
    }
}
