<?php

namespace App\Filament\Resources\HargaPokoks\Exporters;

use App\Models\HargaPokok;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class HargaPokokExporter extends Exporter
{
    protected static ?string $model = HargaPokok::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('nama_komoditi'),
            ExportColumn::make('satuan'),
            ExportColumn::make('harga'),
            ExportColumn::make('tanggal_update'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        return 'Data harga pokok berhasil diekspor.';
    }
}
