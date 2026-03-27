<?php

namespace App\Filament\Resources\SliderHeroes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SliderHeroForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Slider')
                    ->schema([
                        TextInput::make('judul')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Selamat Datang di Lombok Timur')
                            ->columnSpanFull(),
                        TextInput::make('subtitle')
                            ->label('Subtitle')
                            ->maxLength(500)
                            ->placeholder('Contoh: Portal Resmi Pemerintah Kabupaten Lombok Timur')
                            ->columnSpanFull(),
                        FileUpload::make('gambar')
                            ->label('Gambar')
                            ->image()
                            ->imageEditor()
                            ->directory('slider')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->helperText('Ukuran maksimal 5MB. Resolusi disarankan: 1920x600px')
                            ->columnSpanFull(),
                        TextInput::make('url_link')
                            ->label('URL Link')
                            ->url()
                            ->placeholder('https://...')
                            ->helperText('Kosongkan jika tidak ada link')
                            ->columnSpanFull(),
                        TextInput::make('label_tombol')
                            ->label('Label Tombol')
                            ->maxLength(50)
                            ->placeholder('Contoh: Selengkapnya')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make('Pengaturan')
                    ->schema([
                        TextInput::make('urutan')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->helperText('Semakin kecil, semakin awal')
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }
}
