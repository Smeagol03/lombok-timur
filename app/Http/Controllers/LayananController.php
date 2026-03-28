<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Setting;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        $seo = [
            'title' => 'Layanan Publik',
            'description' => 'Akses berbagai layanan publik Pemerintah Kabupaten Lombok Timur. Informasi lengkap tentang pelayanan masyarakat.',
            'keywords' => 'layanan publik, pelayanan masyarakat, pemerintah lombok timur, '.($setting?->meta_keywords ?? ''),
            'ogImage' => $setting?->getFirstMediaUrl('logo') ?: asset('images/og-default.jpg'),
        ];

        return view('pages.layanan.index', $seo);
    }

    public function show(string $slug)
    {
        $layanan = Layanan::where('slug', $slug)->firstOrFail();

        $relatedServices = $layanan->getRelatedServices(3);

        $setting = Setting::first();

        $seo = [
            'title' => $layanan->nama,
            'description' => Str::limit(strip_tags($layanan->deskripsi), 160),
            'keywords' => 'layanan, '.$layanan->nama.', '.($layanan->dinas_terkait ?? 'lombok timur').', lombok timur',
            'ogImage' => $layanan->getFirstMediaUrl('icon') ?: ($setting?->getFirstMediaUrl('logo') ?: asset('images/og-default.jpg')),
            'type' => 'website',
        ];

        $jsonLd = [
            'type' => 'GovernmentService',
            'title' => $layanan->nama,
            'description' => Str::limit(strip_tags($layanan->deskripsi), 200),
            'url' => url()->current(),
            'telephone' => $setting?->contact_phone,
        ];

        return view('pages.layanan.show', array_merge(compact('layanan', 'relatedServices', 'jsonLd'), $seo));
    }
}
