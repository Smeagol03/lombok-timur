<?php

namespace App\Http\Controllers;

use App\Models\Wisata;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.wisata.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $wisata = Wisata::where('slug', $slug)->firstOrFail();

        // Get related tourism
        $relatedWisata = $wisata->getRelatedWisata(3);

        return view('pages.wisata.show', compact('wisata', 'relatedWisata'));
    }
}
