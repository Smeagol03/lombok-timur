<?php

namespace App\Filament\Resources\HargaPokoks\Tables;

use App\Exports\HargaPokokTemplateExport;
use App\Filament\Resources\HargaPokoks\Exporters\HargaPokokExporter;
use App\Filament\Resources\HargaPokoks\Importers\HargaPokokImporter;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Maatwebsite\Excel\Facades\Excel;

class HargaPokoksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_komoditi')
                    ->label('Nama Komoditi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('satuan')
                    ->label('Satuan')
                    ->searchable(),
                TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('tanggal_update')
                    ->label('Tanggal Update')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                ImportAction::make()
                    ->label('Import Excel')
                    ->importer(HargaPokokImporter::class)
                    ->icon('heroicon-o-arrow-up-tray'),
                ExportAction::make()
                    ->label('Export')
                    ->exporter(HargaPokokExporter::class)
                    ->icon('heroicon-o-arrow-down-tray'),
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Action::make('downloadTemplate')
                    ->label('Download Template')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function () {
                        return Excel::download(new HargaPokokTemplateExport, 'template_harga_pokok.csv');
                    }),
            ])
            ->defaultSort('tanggal_update', 'desc');
    }
}
