<?php

namespace App\Filament\Resources\Beritas\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BeritaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->label('Judul Berita')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->debounce(500)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Str::slug($state)))
                    ->placeholder('Masukkan judul berita...')
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->label('Slug URL')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->placeholder('slug-otomatis')
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
                SpatieMediaLibraryFileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->collection('thumbnail')
                    ->image()
                    ->imageEditor()
                    ->maxSize(2048)
                    ->helperText('Max 2MB. JPG, PNG, WebP')
                    ->columnSpanFull(),
                RichEditor::make('konten')
                    ->label('Konten Lengkap')
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
                    ->placeholder('Tulis konten berita...')
                    ->columnSpanFull(),
                Textarea::make('excerpt')
                    ->label('Ringkasan')
                    ->rows(3)
                    ->maxLength(500)
                    ->placeholder('Ringkasan singkat...')
                    ->columnSpanFull(),
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
            ]);
    }
}
