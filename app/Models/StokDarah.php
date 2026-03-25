<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StokDarah extends Model
{
    protected $table = 'stok_darahs';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'golongan',
        'jumlah',
        'tanggal_update',
    ];

    protected $casts = [
        'jumlah' => 'integer',
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

    public function scopeByGolongan($query, $golongan)
    {
        return $query->where('golongan', $golongan);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('tanggal_update', 'desc');
    }

    public function getStatusAttribute(): string
    {
        if ($this->jumlah >= 100) {
            return 'Aman';
        } elseif ($this->jumlah >= 50) {
            return 'Sedang';
        } else {
            return 'Kritis';
        }
    }
}
