<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Berita extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia, Searchable, SoftDeletes;

    protected $table = 'beritas';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'judul',
        'slug',
        'kategori_id',
        'penulis_id',
        'konten',
        'excerpt',
        'thumbnail',
        'status',
        'is_featured',
        'views',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'views' => 'integer',
        'published_at' => 'datetime',
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

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function penulis(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->withResponsiveImages();
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'judul' => $this->judul,
            'excerpt' => $this->excerpt,
            'konten' => strip_tags($this->konten),
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get related news based on category
     */
    public function getRelatedNews(int $limit = 3)
    {
        return static::published()
            ->where('id', '!=', $this->id)
            ->where('kategori_id', $this->kategori_id)
            ->latest('published_at')
            ->limit($limit)
            ->get();
    }
}
