<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Wisata extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia, Searchable;

    protected $table = 'wisatas';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'lokasi',
        'kecamatan',
        'foto_utama',
        'koordinat_lat',
        'koordinat_lng',
    ];

    protected $casts = [
        'koordinat_lat' => 'decimal:8',
        'koordinat_lng' => 'decimal:8',
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
            ->generateSlugsFrom('nama')
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto_utama')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->withResponsiveImages();

        $this->addMediaCollection('galeri')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->withResponsiveImages();
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'deskripsi' => strip_tags($this->deskripsi),
            'lokasi' => $this->lokasi,
            'kecamatan' => $this->kecamatan,
        ];
    }

    public function scopeByKecamatan($query, $kecamatan)
    {
        return $query->where('kecamatan', $kecamatan);
    }

    /**
     * Get related tourism in the same kecamatan
     */
    public function getRelatedWisata(int $limit = 3)
    {
        if (empty($this->kecamatan)) {
            return static::where('id', '!=', $this->id)->limit($limit)->get();
        }

        return static::where('id', '!=', $this->id)
            ->where('kecamatan', $this->kecamatan)
            ->limit($limit)
            ->get();
    }
}
