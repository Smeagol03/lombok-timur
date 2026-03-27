<?php

namespace App\Filament\Resources\HargaPokoks\Pages;

use App\Exports\HargaPokokExport;
use App\Filament\Resources\HargaPokoks\HargaPokokResource;
use App\Imports\HargaPokokImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListHargaPokoks extends ListRecords
{
    protected static string $resource = HargaPokokResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('import')
                ->label('Import Harga')
                ->icon('heroicon-o-arrow-up-tray')
                ->form([
                    FileUpload::make('file')
                        ->label('File Excel')
                        ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
                        ->required()
                        ->maxSize(10240),
                ])
                ->action(function (array $data) {
                    try {
                        $filePath = storage_path('app/'.$data['file']);
                        Excel::import(new HargaPokokImport, $filePath);

                        Notification::make()
                            ->title('Import Berhasil')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Import Gagal')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
            Action::make('export')
                ->label('Export Harga')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    return Excel::download(new HargaPokokExport, 'harga-pokok-'.now()->format('Y-m-d').'.xlsx');
                }),
            CreateAction::make(),
        ];
    }
}
