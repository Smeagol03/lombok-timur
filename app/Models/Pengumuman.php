<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Pengumuman extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia, Searchable, SoftDeletes;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'file_lampiran',
        'is_penting',
        'tanggal_terbit',
        'tanggal_kadaluarsa',
    ];

    protected $casts = [
        'is_penting' => 'boolean',
        'tanggal_terbit' => 'date',
        'tanggal_kadaluarsa' => 'date',
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

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul')
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('lampiran')
            ->acceptsMimeTypes(['application/pdf', 'image/jpeg', 'image/png', 'image/webp']);
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'judul' => $this->judul,
            'konten' => strip_tags($this->konten),
        ];
    }

    public function scopeActive($query)
    {
        return $query->whereDate('tanggal_terbit', '<=', today())
            ->where(function ($q) {
                $q->whereNull('tanggal_kadaluarsa')
                    ->orWhereDate('tanggal_kadaluarsa', '>=', today());
            });
    }

    public function scopePenting($query)
    {
        return $query->where('is_penting', true);
    }
}
