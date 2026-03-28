<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Layanan extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia, Searchable;

    protected $table = 'layanans';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'icon',
        'icon_type',
        'url_eksternal',
        'dinas_terkait',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
        'icon_type' => 'string',
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
        $this->addMediaCollection('icon')
            ->singleFile()
            ->acceptsMimeTypes(['image/svg+xml', 'image/png', 'image/jpeg', 'image/webp']);
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
            'dinas_terkait' => $this->dinas_terkait,
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }

    /**
     * Get related services based on dinas terkait
     */
    public function getRelatedServices(int $limit = 3)
    {
        if (empty($this->dinas_terkait)) {
            return static::active()->ordered()->where('id', '!=', $this->id)->limit($limit)->get();
        }

        return static::active()
            ->where('id', '!=', $this->id)
            ->where('dinas_terkait', $this->dinas_terkait)
            ->ordered()
            ->limit($limit)
            ->get();
    }
}
