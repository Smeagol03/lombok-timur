<?php

namespace App\Filament\Resources\SliderHeroes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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
                Select::make('url_type')
                    ->label('Tipe URL')
                    ->options([
                        'internal' => 'Halaman Website',
                        'external' => 'URL Eksternal',
                    ])
                    ->default('internal')
                    ->live()
                    ->columnSpanFull(),
                Select::make('url_link')
                    ->label('Halaman Tujuan')
                    ->placeholder('Pilih halaman website')
                    ->options([
                        '/' => 'Beranda',
                        '/profil' => 'Profil Daerah',
                        '/layanan' => 'Layanan Publik',
                        '/wisata' => 'Destinasi Wisata',
                        '/berita' => 'Berita',
                        '/pengumuman' => 'Pengumuman',
                        '/pencarian' => 'Pencarian',
                    ])
                    ->native(false)
                    ->searchable()
                    ->visible(fn (callable $get) => $get('url_type') === 'internal' || $get('url_type') === null)
                    ->columnSpanFull(),
                TextInput::make('url_link_external')
                    ->label('URL Eksternal')
                    ->url()
                    ->placeholder('https://...')
                    ->visible(fn (callable $get) => $get('url_type') === 'external')
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
