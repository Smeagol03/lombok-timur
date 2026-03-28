<?php

namespace App\Http\Controllers;

use App\Models\HargaPokok;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class HargaPokokController extends Controller
{
    public function index()
    {
        // Ambil 1 harga terbaru per komoditi dengan histori perubahan
        $prices = HargaPokok::select('harga_poks.*')
            ->selectSub(
                DB::table('harga_poks as hp2')
                    ->select('hp2.harga')
                    ->whereColumn('hp2.nama_komoditi', 'harga_poks.nama_komoditi')
                    ->whereColumn('hp2.tanggal_update', '<', 'harga_poks.tanggal_update')
                    ->orderByDesc('hp2.tanggal_update')
                    ->limit(1),
                'harga_sebelumnya'
            )
            ->latest('tanggal_update')
            ->get()
            ->groupBy('nama_komoditi')
            ->map(function ($items) {
                $item = $items->first();
                $hargaLama = $item->harga_sebelumnya;

                if ($hargaLama === null) {
                    $item->change = ['type' => 'same', 'value' => 0];
                } else {
                    $diff = $item->harga - $hargaLama;
                    if ($diff > 0) {
                        $item->change = ['type' => 'up', 'value' => $diff];
                    } elseif ($diff < 0) {
                        $item->change = ['type' => 'down', 'value' => abs($diff)];
                    } else {
                        $item->change = ['type' => 'same', 'value' => 0];
                    }
                }

                return $item;
            })
            ->values();

        $lastUpdate = HargaPokok::latest('tanggal_update')->value('tanggal_update');

        $setting = Setting::first();
        $ogImage = $setting?->getFirstMediaUrl('logo') ?: asset('images/og-default.jpg');

        return view('pages.harga-pokok', [
            'title' => 'Harga Bahan Pokok - Lombok Timur',
            'description' => 'Informasi harga bahan kebutuhan pokok terkini di Kabupaten Lombok Timur. Pantau harga beras, cabe, bawang, minyak, dan lainnya.',
            'keywords' => 'harga bahan pokok lombok timur, harga pangan, harga beras lombok, harga cabe lombok, harga kebutuhan pokok,info harga lombok timur',
            'ogImage' => $ogImage,
            'prices' => $prices,
            'lastUpdate' => $lastUpdate,
        ]);
    }
}
