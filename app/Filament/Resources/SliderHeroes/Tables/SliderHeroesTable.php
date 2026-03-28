<?php

namespace App\Filament\Resources\SliderHeroes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class SliderHeroesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('gambar')
                    ->label('Gambar')
                    ->collection('gambar')
                    ->circular()
                    ->size(50),
                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->searchable()
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('url_link')
                    ->label('URL Link')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('label_tombol')
                    ->label('Label Tombol')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('urutan')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Aktif'),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
