<?php

namespace App\Filament\Resources\LinkBanners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LinkBannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Instagram Lombok Timur')
                    ->columnSpanFull(),
                TextInput::make('url')
                    ->label('URL')
                    ->url()
                    ->required()
                    ->placeholder('https://...')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Deskripsi Singkat')
                    ->maxLength(100)
                    ->rows(2)
                    ->placeholder('Deskripsi singkat (max 100 karakter)')
                    ->helperText('Maksimal 100 karakter')
                    ->columnSpanFull(),
                Select::make('url_type')
                    ->label('Tipe URL')
                    ->options([
                        'internal' => 'Halaman Website',
                        'external' => 'Media Sosial / Eksternal',
                    ])
                    ->default('internal')
                    ->live()
                    ->columnSpanFull(),
                Select::make('url')
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
                    ->required(fn (callable $get) => $get('url_type') === 'internal' || $get('url_type') === null)
                    ->columnSpanFull(),
                TextInput::make('url_external')
                    ->label('URL Eksternal')
                    ->url()
                    ->placeholder('https://instagram.com/..., https://facebook.com/...')
                    ->visible(fn (callable $get) => $get('url_type') === 'external')
                    ->required(fn (callable $get) => $get('url_type') === 'external')
                    ->columnSpanFull(),
                Select::make('icon')
                    ->label('Icon Media Sosial')
                    ->options([
                        'facebook' => 'Facebook',
                        'instagram' => 'Instagram',
                        'twitter' => 'Twitter/X',
                        'youtube' => 'YouTube',
                        'tiktok' => 'TikTok',
                        'whatsapp' => 'WhatsApp',
                        'telegram' => 'Telegram',
                        'website' => 'Website',
                        'email' => 'Email',
                        'maps' => 'Google Maps',
                        'booking' => 'Booking/Travel',
                        'news' => 'Berita',
                    ])
                    ->native(false)
                    ->searchable()
                    ->placeholder('Pilih icon')
                    ->visible(fn (callable $get) => $get('url_type') === 'external')
                    ->columnSpanFull(),
                TextInput::make('urutan')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->columnSpanFull(),
                FileUpload::make('gambar')
                    ->label('Gambar Thumbnail')
                    ->image()
                    ->imageEditor()
                    ->directory('link-banners')
                    ->visibility('public')
                    ->maxSize(2048)
                    ->helperText('Max 2MB. Opsional - akan digunakan icon jika tidak ada gambar')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->columnSpanFull(),
            ]);
    }
}
