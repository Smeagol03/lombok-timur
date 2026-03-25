<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Agenda extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'agendas';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'judul',
        'deskripsi',
        'jenis',
        'lokasi',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('dokumen')
            ->acceptsMimeTypes(['application/pdf']);
    }

    public function scopeBupati($query)
    {
        return $query->where('jenis', 'bupati');
    }

    public function scopeWabup($query)
    {
        return $query->where('jenis', 'wabup');
    }

    public function scopeSekda($query)
    {
        return $query->where('jenis', 'sekda');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('tanggal', today());
    }

    public function scopeUpcoming($query)
    {
        return $query->whereDate('tanggal', '>=', today())
            ->orderBy('tanggal')
            ->orderBy('jam_mulai');
    }
}
