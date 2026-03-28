<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\Setting;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        $seo = [
            'title' => 'Pengumuman',
            'description' => 'Daftar pengumuman resmi dari Pemerintah Kabupaten Lombok Timur, Nusa Tenggara Barat.',
            'keywords' => 'pengumuman, pemberitahuan, informasi resmi, lombok timur, '.($setting?->meta_keywords ?? ''),
            'ogImage' => $setting?->getFirstMediaUrl('logo') ?: asset('images/og-default.jpg'),
        ];

        return view('pages.pengumuman.index', $seo);
    }

    public function show(string $slug)
    {
        $pengumuman = Pengumuman::where('slug', $slug)
            ->with('media')
            ->firstOrFail();

        $setting = Setting::first();

        $seo = [
            'title' => $pengumuman->judul,
            'description' => Str::limit(strip_tags($pengumuman->konten), 160),
            'keywords' => 'pengumuman, '.$pengumuman->judul.', lombok timur',
            'ogImage' => $pengumuman->getFirstMediaUrl() ?: ($setting?->getFirstMediaUrl('logo') ?: asset('images/og-default.jpg')),
            'type' => 'article',
            'publishedTime' => $pengumuman->created_at->toIso8601String(),
            'modifiedTime' => $pengumuman->updated_at->toIso8601String(),
        ];

        return view('pages.pengumuman.show', array_merge(compact('pengumuman'), $seo));
    }
}
