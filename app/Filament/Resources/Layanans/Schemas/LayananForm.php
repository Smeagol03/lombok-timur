<?php

namespace App\Filament\Resources\Layanans\Schemas;

use Filament\Forms\Components\RichEditor;
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
                TextInput::make('icon')
                    ->label('Icon')
                    ->placeholder('heroicon-o-building-library')
                    ->columnSpanFull(),
                TextInput::make('url_eksternal')
                    ->label('URL Eksternal')
                    ->url()
                    ->placeholder('https://...')
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
