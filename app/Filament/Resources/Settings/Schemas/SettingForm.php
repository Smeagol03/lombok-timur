<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Website')
                    ->description('Pengaturan dasar website')
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Nama Website')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Portal Lombok Timur')
                            ->columnSpanFull(),
                        TextInput::make('site_tagline')
                            ->label('Tagline')
                            ->maxLength(255)
                            ->placeholder('Melayani dengan transparansi dan profesionalisme')
                            ->columnSpanFull(),
                        Textarea::make('site_description')
                            ->label('Deskripsi Website')
                            ->maxLength(1000)
                            ->placeholder('Deskripsi singkat tentang website...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make('Logo & Favicon')
                    ->description('Upload logo dan favicon website')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('logo')
                            ->label('Logo Website')
                            ->collection('logo')
                            ->image()
                            ->imageEditor()
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                            ->helperText('Format: JPG, PNG, WEBP, atau SVG. Max 2MB.')
                            ->columnSpan(1),
                        SpatieMediaLibraryFileUpload::make('favicon')
                            ->label('Favicon')
                            ->collection('favicon')
                            ->maxSize(1024)
                            ->acceptedFileTypes(['image/x-icon', 'image/vnd.microsoft.icon', 'image/ico', 'image/png', 'image/jpeg'])
                            ->helperText('Format: ICO atau PNG. Ukuran: 32x32px atau 64x64px.')
                            ->columnSpan(1),
                    ])
                    ->columns(2),

                Section::make('Kontak')
                    ->description('Informasi kontak yang ditampilkan di website')
                    ->schema([
                        TextInput::make('contact_phone')
                            ->label('Telepon')
                            ->tel()
                            ->placeholder('(0376) 123456')
                            ->columnSpan(1),
                        TextInput::make('contact_email')
                            ->label('Email')
                            ->email()
                            ->placeholder('info@lomboktimur.go.id')
                            ->columnSpan(1),
                        Textarea::make('contact_address')
                            ->label('Alamat')
                            ->placeholder('Jl. Example No. 123, Lombok Timur')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('SEO & Meta')
                    ->description('Pengaturan untuk mesin pencari (SEO)')
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(60)
                            ->placeholder('Portal Resmi Pemerintah Kabupaten Lombok Timur')
                            ->helperText('Judul yang tampil di tab browser dan hasil pencarian. Maks 60 karakter.')
                            ->columnSpanFull(),
                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->maxLength(160)
                            ->placeholder('Portal resmi Pemerintah Kabupaten Lombok Timur...')
                            ->rows(2)
                            ->helperText('Deskripsi singkat yang tampil di hasil pencarian. Maks 160 karakter.')
                            ->columnSpanFull(),
                        TextInput::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->maxLength(255)
                            ->placeholder('lombok timur, pemerintah, ntb, layanan publik')
                            ->helperText('Kata kunci pisahkan dengan koma.')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make('Media Sosial')
                    ->description('Link media sosial website')
                    ->schema([
                        TextInput::make('social_facebook')
                            ->label('Facebook')
                            ->url()
                            ->placeholder('https://facebook.com/...')
                            ->prefixIcon('heroicon-m-link')
                            ->columnSpan(1),
                        TextInput::make('social_instagram')
                            ->label('Instagram')
                            ->url()
                            ->placeholder('https://instagram.com/...')
                            ->prefixIcon('heroicon-m-link')
                            ->columnSpan(1),
                        TextInput::make('social_twitter')
                            ->label('Twitter / X')
                            ->url()
                            ->placeholder('https://twitter.com/...')
                            ->prefixIcon('heroicon-m-link')
                            ->columnSpan(1),
                        TextInput::make('social_youtube')
                            ->label('YouTube')
                            ->url()
                            ->placeholder('https://youtube.com/...')
                            ->prefixIcon('heroicon-m-link')
                            ->columnSpan(1),
                    ])
                    ->columns(2),
            ]);
    }
}
