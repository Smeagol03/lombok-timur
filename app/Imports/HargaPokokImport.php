<?php

namespace App\Imports;

use App\Models\HargaPokok;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class HargaPokokImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        $id = $row['id'] ?? null;

        if ($id && HargaPokok::where('id', $id)->exists()) {
            HargaPokok::where('id', $id)->update([
                'nama_komoditi' => $row['nama_komoditi'],
                'satuan' => $row['satuan'],
                'harga' => (int) $row['harga'],
                'tanggal_update' => $row['tanggal_update'] ?? now(),
            ]);

            return null;
        }

        return new HargaPokok([
            'id' => $id ?? (string) Str::ulid(),
            'nama_komoditi' => $row['nama_komoditi'],
            'satuan' => $row['satuan'],
            'harga' => (int) $row['harga'],
            'tanggal_update' => $row['tanggal_update'] ?? now(),
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_komoditi' => ['required', 'string', 'max:255'],
            'satuan' => ['required', 'string', 'max:50'],
            'harga' => ['required', 'integer', 'min:0'],
            'tanggal_update' => ['nullable', 'date'],
        ];
    }
}
