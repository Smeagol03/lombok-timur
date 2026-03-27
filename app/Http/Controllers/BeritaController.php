<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.berita.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $berita = Berita::where('slug', $slug)
            ->with(['kategori', 'penulis'])
            ->firstOrFail();

        // Increment view count
        $berita->increment('views');

        // Get related news
        $relatedNews = $berita->getRelatedNews(3);

        return view('pages.berita.show', compact('berita', 'relatedNews'));
    }
}
