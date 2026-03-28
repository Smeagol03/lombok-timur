<?php

namespace App\Filament\Resources\HargaPokoks\Importers;

use App\Models\HargaPokok;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class HargaPokokImporter extends Importer
{
    protected static ?string $model = HargaPokok::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nama_komoditi')
                ->requiredMapping()
                ->rules(['required', 'string', 'max:255']),
            ImportColumn::make('satuan')
                ->requiredMapping()
                ->rules(['required', 'string', 'max:50']),
            ImportColumn::make('harga')
                ->requiredMapping()
                ->rules(['required', 'integer', 'min:0']),
            ImportColumn::make('tanggal_update')
                ->rules(['nullable', 'date']),
        ];
    }

    public function resolveRecord(): ?HargaPokok
    {
        $id = $this->data['id'] ?? null;

        if ($id) {
            return HargaPokok::find($id);
        }

        return new HargaPokok;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        return 'Data harga pokok berhasil diimpor.';
    }
}
