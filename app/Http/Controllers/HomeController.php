<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $featuredServices = Layanan::active()
            ->with('media')
            ->ordered()
            ->limit(5)
            ->get();

        $setting = Setting::first();

        $seo = [
            'title' => $setting?->meta_title ?? 'Portal Resmi Pemerintah Kabupaten Lombok Timur',
            'description' => $setting?->meta_description ?? 'Portal resmi Pemerintah Kabupaten Lombok Timur, Nusa Tenggara Barat. Informasi berita, pengumuman, layanan publik, dan destinasi wisata.',
            'keywords' => $setting?->meta_keywords ?? 'lombok timur, pemerintah daerah, ntb, indonesia, berita, pengumuman, layanan publik, wisata',
            'ogImage' => $setting?->getFirstMediaUrl('logo') ?: asset('images/og-default.jpg'),
        ];

        return view('pages.home', array_merge(compact('featuredServices'), $seo));
    }
}
