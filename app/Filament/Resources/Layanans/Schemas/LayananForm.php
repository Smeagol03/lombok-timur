<?php

namespace App\Filament\Resources\Layanans\Schemas;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LayananForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->label('Nama Layanan')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->debounce(500)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Str::slug($state)))
                    ->placeholder('Nama layanan...')
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->label('Slug URL')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->placeholder('slug-otomatis')
                    ->columnSpanFull(),
                RichEditor::make('deskripsi')
                    ->label('Deskripsi')
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'bulletList',
                        'orderedList',
                        'link',
                        'undo',
                        'redo',
                    ])
                    ->placeholder('Deskripsikan layanan...')
                    ->columnSpanFull(),

                Radio::make('icon_type')
                    ->label('Tipe Ikon')
                    ->options([
                        'icon' => 'Icon (Heroicons)',
                        'image' => 'Gambar/Logo',
                    ])
                    ->default('icon')
                    ->live()
                    ->columnSpanFull(),

                TextInput::make('icon')
                    ->label('Pilih Icon')
                    ->placeholder('heroicon-o-building-library')
                    ->helperText('Masukkan nama icon Heroicons. Contoh: heroicon-o-building-library, heroicon-o-identification, heroicon-o-academic-cap')
                    ->visible(fn ($get) => $get('icon_type') === 'icon')
                    ->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('icon_image')
                    ->label('Upload Logo/Gambar')
                    ->collection('icon')
                    ->image()
                    ->imageEditor()
                    ->maxSize(512)
                    ->acceptedFileTypes(['image/svg+xml', 'image/png', 'image/jpeg', 'image/webp'])
                    ->helperText('Format: PNG, JPG, WEBP, atau SVG. Maks 500KB. Ukuran ideal: 128x128px atau 256x256px.')
                    ->visible(fn ($get) => $get('icon_type') === 'image')
                    ->columnSpanFull(),

                TextInput::make('url_eksternal')
                    ->label('URL Eksternal')
                    ->url()
                    ->placeholder('https://...')
                    ->helperText('Kosongkan jika layanan internal')
                    ->columnSpanFull(),
                TextInput::make('dinas_terkait')
                    ->label('Dinas Terkait')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Nama dinas...')
                    ->columnSpanFull(),
                TextInput::make('urutan')
                    ->label('Urutan Tampilan')
                    ->numeric()
                    ->default(0)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Layanan Aktif')
                    ->default(true)
                    ->columnSpanFull(),
            ]);
    }
}
