<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HargaPokok extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'nama_komoditi',
        'satuan',
        'harga',
        'tanggal_update',
    ];

    protected $casts = [
        'harga' => 'integer',
        'tanggal_update' => 'date',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::ulid();
            }
        });
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('tanggal_update', 'desc');
    }

    public function scopeByKomoditi($query, $nama)
    {
        return $query->where('nama_komoditi', $nama);
    }
}
