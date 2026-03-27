<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.pengumuman.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $pengumuman = Pengumuman::where('slug', $slug)
            ->with('media')
            ->firstOrFail();

        return view('pages.pengumuman.show', compact('pengumuman'));
    }
}
