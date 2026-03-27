<?php

namespace App\Filament\Resources\LinkBanners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LinkBannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Website Resmi')
                    ->columnSpanFull(),
                TextInput::make('url')
                    ->label('URL')
                    ->url()
                    ->required()
                    ->placeholder('https://...')
                    ->columnSpanFull(),
                FileUpload::make('gambar')
                    ->label('Gambar Banner')
                    ->image()
                    ->imageEditor()
                    ->directory('link-banners')
                    ->visibility('public')
                    ->maxSize(2048)
                    ->helperText('Max 2MB')
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
