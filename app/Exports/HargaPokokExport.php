<?php

namespace App\Exports;

use App\Models\HargaPokok;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HargaPokokExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    public function collection()
    {
        return HargaPokok::orderBy('nama_komoditi')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Komoditi',
            'Satuan',
            'Harga (Rp)',
            'Tanggal Update',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->nama_komoditi,
            $row->satuan,
            $row->harga,
            $row->tanggal_update?->format('Y-m-d'),
        ];
    }
}
