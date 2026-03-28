<?php

namespace App\View\Components;

use App\Models\Setting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SeoMeta extends Component
{
    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public ?string $keywords = null,
        public ?string $image = null,
        public ?string $url = null,
        public ?string $type = 'website',
        public ?string $author = null,
        public bool $noIndex = false,
        public ?string $publishedTime = null,
        public ?string $modifiedTime = null,
        public ?string $section = null,
    ) {}

    public function render(): View|Closure|string
    {
        $setting = Setting::first();

        $defaultTitle = $setting?->site_name ?? config('app.name');
        $defaultDescription = $setting?->meta_description ?? $setting?->site_description ?? 'Portal Resmi Pemerintah Kabupaten Lombok Timur - Melayani dengan Transparan dan Profesional';
        $defaultKeywords = $setting?->meta_keywords ?? 'lombok timur, pemerintah daerah, ntb, indonesia, berita, pengumuman, layanan publik';
        $defaultImage = $setting?->getFirstMediaUrl('logo') ?: asset('images/og-default.jpg');
        $defaultUrl = url()->current();

        $title = $this->title ? "{$this->title} - {$defaultTitle}" : ($setting?->meta_title ?? $defaultTitle);
        $description = $this->description ?? $defaultDescription;
        $keywords = $this->keywords ?? $defaultKeywords;
        $image = $this->image ?? $defaultImage;
        $url = $this->url ?? $defaultUrl;

        return view('components.seo-meta', [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'image' => $image,
            'url' => $url,
            'type' => $this->type,
            'author' => $this->author ?? 'Pemerintah Kabupaten Lombok Timur',
            'noIndex' => $this->noIndex,
            'siteName' => $defaultTitle,
            'publishedTime' => $this->publishedTime,
            'modifiedTime' => $this->modifiedTime,
            'section' => $this->section,
        ]);
    }
}
