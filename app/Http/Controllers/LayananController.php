<?php

namespace App\Http\Controllers;

use App\Models\Layanan;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.layanan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $layanan = Layanan::where('slug', $slug)->firstOrFail();

        // Get related services
        $relatedServices = $layanan->getRelatedServices(3);

        return view('pages.layanan.show', compact('layanan', 'relatedServices'));
    }
}
