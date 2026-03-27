<?php

namespace App\Http\Controllers;

use App\Models\Layanan;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        // Get featured services for homepage
        $featuredServices = Layanan::active()
            ->ordered()
            ->limit(5)
            ->get();

        return view('pages.home', compact('featuredServices'));
    }
}
