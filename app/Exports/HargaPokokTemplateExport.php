<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HargaPokokTemplateExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return collect([
            [
                'nama_komoditi' => 'Contoh: Beras Premium',
                'satuan' => 'Kg',
                'harga' => 13000,
                'tanggal_update' => now()->format('Y-m-d'),
            ],
            [
                'nama_komoditi' => 'Contoh: Minyak Goreng',
                'satuan' => 'Liter',
                'harga' => 18000,
                'tanggal_update' => now()->format('Y-m-d'),
            ],
            [
                'nama_komoditi' => 'Contoh: Cabe Merah',
                'satuan' => 'Kg',
                'harga' => 35000,
                'tanggal_update' => now()->format('Y-m-d'),
            ],
        ]);
    }

    public function headings(): array
    {
        return [
            'nama_komoditi',
            'satuan',
            'harga',
            'tanggal_update',
        ];
    }
}
