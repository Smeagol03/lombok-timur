<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'site_name',
        'site_tagline',
        'site_description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'contact_phone',
        'contact_email',
        'contact_address',
        'social_facebook',
        'social_instagram',
        'social_twitter',
        'social_youtube',
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
        $this->addMediaCollection('logo')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml', 'image/gif'])
            ->withResponsiveImages();

        $this->addMediaCollection('favicon')
            ->singleFile()
            ->acceptsMimeTypes(['image/x-icon', 'image/vnd.microsoft.icon', 'image/png', 'image/jpeg', 'image/gif', 'image/ico']);
    }

    public static function getInstance(): self
    {
        return static::firstOrCreate([], [
            'site_name' => 'Portal Lombok Timur',
            'site_tagline' => 'Melayani dengan transparansi dan profesionalisme',
        ]);
    }
}
