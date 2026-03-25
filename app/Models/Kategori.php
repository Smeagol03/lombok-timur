<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Kategori extends Model
{
    use HasSlug;

    protected $table = 'kategoris';

    protected $fillable = ['nama', 'slug', 'warna'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nama')
            ->saveSlugsTo('slug');
    }

    public function beritas(): HasMany
    {
        return $this->hasMany(Berita::class);
    }
}
