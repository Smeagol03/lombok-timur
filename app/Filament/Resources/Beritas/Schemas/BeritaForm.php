<?php

namespace App\Filament\Resources\Beritas\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BeritaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Berita')
                    ->schema([
                        TextInput::make('judul')
                            ->label('Judul')
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
                        Select::make('kategori_id')
                            ->label('Kategori')
                            ->relationship('kategori', 'nama')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),
                        Select::make('penulis_id')
                            ->label('Penulis')
                            ->relationship('penulis', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make('Konten')
                    ->schema([
                        FileUpload::make('thumbnail')
                            ->label('Thumbnail')
                            ->image()
                            ->imageEditor()
                            ->directory('berita/thumbnails')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->helperText('Ukuran maksimal 2MB. Format: JPG, PNG, WebP')
                            ->columnSpanFull(),
                        RichEditor::make('konten')
                            ->label('Konten')
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
                            ->columnSpanFull(),
                        Textarea::make('excerpt')
                            ->label('Ringkasan')
                            ->rows(3)
                            ->maxLength(500)
                            ->helperText('Ringkasan singkat berita (maks. 500 karakter)')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make('Pengaturan Publikasi')
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->required()
                            ->default('draft')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'archived' => 'Archived',
                            ])
                            ->columnSpanFull(),
                        DateTimePicker::make('published_at')
                            ->label('Tanggal Publikasi')
                            ->default(now())
                            ->native(false)
                            ->columnSpanFull(),
                        Toggle::make('is_featured')
                            ->label('Tampilkan di Beranda')
                            ->default(false)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }
}
