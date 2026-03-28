<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Wisata;
use Illuminate\Support\Str;

class WisataController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        $seo = [
            'title' => 'Destinasi Wisata',
            'description' => 'Jelajahi destinasi wisata indah di Kabupaten Lombok Timur, Nusa Tenggara Barat. Pantai, gunung, dan budaya unik menanti Anda.',
            'keywords' => 'wisata lombok timur, destinasi wisata, pantai, gunung, budaya, ntb, '.($setting?->meta_keywords ?? ''),
            'ogImage' => $setting?->getFirstMediaUrl('logo') ?: asset('images/og-default.jpg'),
        ];

        return view('pages.wisata.index', $seo);
    }

    public function show(string $slug)
    {
        $wisata = Wisata::where('slug', $slug)->firstOrFail();

        $relatedWisata = $wisata->getRelatedWisata(3);

        $setting = Setting::first();

        $seo = [
            'title' => $wisata->nama,
            'description' => Str::limit(strip_tags($wisata->deskripsi), 160),
            'keywords' => 'wisata, '.$wisata->nama.', '.($wisata->kecamatan ?? 'lombok timur').', lombok timur, ntb',
            'ogImage' => $wisata->getFirstMediaUrl('foto_utama') ?: ($setting?->getFirstMediaUrl('logo') ?: asset('images/og-default.jpg')),
            'type' => 'place',
        ];

        $jsonLd = [
            'type' => 'TouristAttraction',
            'title' => $wisata->nama,
            'description' => Str::limit(strip_tags($wisata->deskripsi), 200),
            'image' => $wisata->getFirstMediaUrl('foto_utama') ?: ($setting?->getFirstMediaUrl('logo') ?: asset('images/og-default.jpg')),
            'url' => url()->current(),
            'address' => $wisata->lokasi.', '.($wisata->kecamatan ?? '').', Lombok Timur, NTB',
            'geo' => [
                'lat' => $wisata->koordinat_lat,
                'lng' => $wisata->koordinat_lng,
            ],
        ];

        return view('pages.wisata.show', array_merge(compact('wisata', 'relatedWisata', 'jsonLd'), $seo));
    }
}
