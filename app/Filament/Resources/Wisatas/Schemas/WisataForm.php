<?php

namespace App\Filament\Resources\Wisatas\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WisataForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->label('Nama Wisata')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->debounce(500)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Str::slug($state)))
                    ->placeholder('Nama destinasi...')
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
                        'h2',
                        'h3',
                        'link',
                        'blockquote',
                        'undo',
                        'redo',
                    ])
                    ->placeholder('Deskripsikan wisata...')
                    ->columnSpanFull(),
                TextInput::make('kecamatan')
                    ->label('Kecamatan')
                    ->required()
                    ->maxLength(100)
                    ->placeholder('Nama kecamatan...')
                    ->columnSpanFull(),
                TextInput::make('lokasi')
                    ->label('Alamat Lengkap')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Alamat lengkap...')
                    ->columnSpanFull(),
                FileUpload::make('foto_utama')
                    ->label('Foto Utama')
                    ->image()
                    ->imageEditor()
                    ->directory('wisata/foto')
                    ->visibility('public')
                    ->maxSize(2048)
                    ->helperText('Max 2MB')
                    ->columnSpanFull(),
                FileUpload::make('galeri')
                    ->label('Galeri Foto')
                    ->image()
                    ->multiple()
                    ->directory('wisata/galeri')
                    ->visibility('public')
                    ->maxFiles(10)
                    ->helperText('Max 10 foto')
                    ->columnSpanFull(),
                TextInput::make('koordinat_lat')
                    ->label('Latitude')
                    ->numeric()
                    ->placeholder('-8.123456')
                    ->columnSpanFull(),
                TextInput::make('koordinat_lng')
                    ->label('Longitude')
                    ->numeric()
                    ->placeholder('116.123456')
                    ->columnSpanFull(),
            ]);
    }
}
