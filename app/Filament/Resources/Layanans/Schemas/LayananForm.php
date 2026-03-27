<?php

namespace App\Filament\Resources\Layanans\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LayananForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Layanan')
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama Layanan')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->debounce(500)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Str::slug($state)))
                            ->columnSpanFull(),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
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
                            ->columnSpanFull(),
                        TextInput::make('icon')
                            ->label('Icon')
                            ->required()
                            ->placeholder('heroicon-o-building-library')
                            ->helperText('Nama icon Heroicons')
                            ->columnSpanFull(),
                        TextInput::make('url_eksternal')
                            ->label('URL Eksternal')
                            ->url()
                            ->placeholder('https://...')
                            ->helperText('URL layanan eksternal')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make('Pengaturan')
                    ->schema([
                        TextInput::make('dinas_terkait')
                            ->label('Dinas Terkait')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('urutan')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->helperText('Urutan tampilan')
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
