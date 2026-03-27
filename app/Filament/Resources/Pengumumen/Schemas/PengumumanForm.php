<?php

namespace App\Filament\Resources\Pengumumen\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PengumumanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pengumuman')
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
                        FileUpload::make('lampiran')
                            ->label('Lampiran')
                            ->directory('pengumuman/lampiran')
                            ->visibility('public')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(10240)
                            ->helperText('Maksimal 10MB. Format: PDF, Gambar')
                            ->columnSpanFull(),
                        Toggle::make('is_penting')
                            ->label('Tandai sebagai Penting')
                            ->default(false)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make('Pengaturan Publikasi')
                    ->schema([
                        DatePicker::make('tanggal_terbit')
                            ->label('Tanggal Terbit')
                            ->required()
                            ->default(now())
                            ->native(false)
                            ->columnSpanFull(),
                        DatePicker::make('tanggal_kadaluarsa')
                            ->label('Tanggal Kadaluarsa')
                            ->native(false)
                            ->helperText('Kosongkan jika tidak ada batas waktu')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }
}
