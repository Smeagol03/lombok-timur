<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Setting;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        $seo = [
            'title' => 'Berita Terbaru',
            'description' => $setting?->meta_description ?? 'Berita terkini dan informasi terbaru dari Pemerintah Kabupaten Lombok Timur.',
            'keywords' => 'berita, berita lombok timur, berita terkini, informasi pemerintah, '.($setting?->meta_keywords ?? ''),
            'ogImage' => $setting?->getFirstMediaUrl('logo') ?: asset('images/og-default.jpg'),
        ];

        return view('pages.berita.index', $seo);
    }

    public function show(string $slug)
    {
        $berita = Berita::where('slug', $slug)
            ->with(['kategori', 'penulis'])
            ->firstOrFail();

        $berita->increment('views');

        $relatedNews = $berita->getRelatedNews(3);

        $setting = Setting::first();
        $siteName = $setting?->site_name ?? config('app.name');

        $seo = [
            'title' => $berita->judul,
            'description' => $berita->excerpt ?? Str::limit(strip_tags($berita->konten), 160),
            'keywords' => 'berita, '.($berita->kategori?->nama ?? 'lombok timur').', lombok timur',
            'ogImage' => $berita->getFirstMediaUrl('thumbnail') ?: ($setting?->getFirstMediaUrl('logo') ?: asset('images/og-default.jpg')),
            'type' => 'article',
            'publishedTime' => $berita->published_at?->toIso8601String(),
            'modifiedTime' => $berita->updated_at->toIso8601String(),
            'section' => $berita->kategori?->nama,
            'author' => $berita->penulis?->name,
        ];

        $jsonLd = [
            'type' => 'NewsArticle',
            'title' => $berita->judul,
            'description' => $berita->excerpt ?? Str::limit(strip_tags($berita->konten), 200),
            'image' => $berita->getFirstMediaUrl('thumbnail') ?: ($setting?->getFirstMediaUrl('logo') ?: asset('images/og-default.jpg')),
            'url' => url()->current(),
            'datePublished' => $berita->published_at?->toIso8601String(),
            'dateModified' => $berita->updated_at->toIso8601String(),
            'author' => $berita->penulis?->name,
        ];

        return view('pages.berita.show', array_merge(compact('berita', 'relatedNews', 'jsonLd'), $seo));
    }
}
