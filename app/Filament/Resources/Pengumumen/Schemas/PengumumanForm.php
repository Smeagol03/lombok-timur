<?php

namespace App\Filament\Resources\Pengumumen\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PengumumanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->label('Judul Pengumuman')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->debounce(500)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Str::slug($state)))
                    ->placeholder('Masukkan judul...')
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->label('Slug URL')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->placeholder('slug-otomatis')
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
                    ->placeholder('Tulis konten...')
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('lampiran')
                    ->label('File Lampiran')
                    ->collection('lampiran')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->maxSize(10240)
                    ->helperText('Max 10MB. PDF, JPG, PNG')
                    ->columnSpanFull(),
                Toggle::make('is_penting')
                    ->label('Pengumuman Penting')
                    ->default(false)
                    ->columnSpanFull(),
                DatePicker::make('tanggal_terbit')
                    ->label('Tanggal Terbit')
                    ->required()
                    ->default(now())
                    ->native(false)
                    ->columnSpanFull(),
                DatePicker::make('tanggal_kadaluarsa')
                    ->label('Tanggal Kadaluarsa')
                    ->native(false)
                    ->helperText('Kosongkan jika tidak ada batas')
                    ->columnSpanFull(),
            ]);
    }
}
