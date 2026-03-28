<?php

use App\Models\HargaPokok;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    #[Computed]
    public function prices()
    {
        // Ambil semua data dengan harga sebelumnya dalam 1 query
        $prices = HargaPokok::select('harga_poks.*')
            ->selectSub(
                DB::table('harga_poks as hp2')
                    ->select('hp2.harga')
                    ->whereColumn(
                        'hp2.nama_komoditi',
                        'harga_poks.nama_komoditi',
                    )
                    ->whereColumn(
                        'hp2.tanggal_update',
                        '<',
                        'harga_poks.tanggal_update',
                    )
                    ->orderByDesc('hp2.tanggal_update')
                    ->limit(1),
                'harga_sebelumnya',
            )
            ->latest('tanggal_update')
            ->take(20)
            ->get()
            ->map(function ($price) {
                $hargaLama = $price->harga_sebelumnya;

                if ($hargaLama === null) {
                    $price->change = ['type' => 'same', 'value' => 0];
                } else {
                    $diff = $price->harga - $hargaLama;
                    if ($diff > 0) {
                        $price->change = ['type' => 'up', 'value' => $diff];
                    } elseif ($diff < 0) {
                        $price->change = [
                            'type' => 'down',
                            'value' => abs($diff),
                        ];
                    } else {
                        $price->change = ['type' => 'same', 'value' => 0];
                    }
                }

                return $price;
            });

        return $prices;
    }

    #[Computed]
    public function lastUpdate()
    {
        return HargaPokok::latest('tanggal_update')->value('tanggal_update');
    }
};
?>

<div x-data="{ paused: false }" @mouseenter="paused = true" @mouseleave="paused = false">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4">
        <div>
            <h2 class="font-heading text-lg md:text-xl font-bold text-primary">Harga Bahan Pokok</h2>
            @if($this->lastUpdate)
            <p class="text-xs text-gray-500">Update: {{ $this->lastUpdate->format('d M Y') }}</p>
            @endif
        </div>
        <a href="{{ url('/harga-pokok') }}" class="text-xs font-medium text-primary hover:text-primary-dark flex items-center gap-1">
            Selengkapnya
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    <div class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 rounded-lg overflow-hidden border border-gray-700">
        @if($this->prices->count() > 0)
        {{-- LED Ticker Container - Vertical Scroll --}}
        <div class="relative overflow-hidden" style="height: 460px;">
            <div
                class="absolute w-full animate-ticker"
                :style="paused ? 'animation-play-state: paused' : 'animation-play-state: running'"
            >
                @foreach($this->prices as $price)
                <div class="flex items-center justify-between px-4 py-3 border-b border-gray-700/50 hover:bg-white/5 transition-colors">
                    <div class="flex items-center gap-3">
                        <span class="w-1.5 h-1.5 rounded-full {{ $price->change['type'] === 'up' ? 'bg-red-500 shadow-[0_0_6px_rgba(239,68,68,0.8)]' : ($price->change['type'] === 'down' ? 'bg-green-500 shadow-[0_0_6px_rgba(34,197,94,0.8)]' : 'bg-gray-500') }}"></span>
                        <span class="font-medium text-sm text-green-400 drop-shadow-[0_0_8px_rgba(74,222,128,0.6)]">{{ $price->nama_komoditi }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-400">{{ $price->satuan }}</span>
                        <span class="font-bold text-sm text-green-400 tabular-nums drop-shadow-[0_0_8px_rgba(74,222,128,0.6)]">
                            Rp {{ number_format($price->harga, 0, ',', '.') }}
                        </span>
                        @if($price->change['type'] === 'up')
                            <span class="text-xs text-red-400 drop-shadow-[0_0_6px_rgba(248,113,113,0.6)]">▲</span>
                        @elseif($price->change['type'] === 'down')
                            <span class="text-xs text-green-400 drop-shadow-[0_0_6px_rgba(74,222,128,0.6)]">▼</span>
                        @endif
                    </div>
                </div>
                @endforeach

                {{-- Duplicate for seamless loop --}}
                @foreach($this->prices as $price)
                <div class="flex items-center justify-between px-4 py-3 border-b border-gray-700/50 hover:bg-white/5 transition-colors">
                    <div class="flex items-center gap-3">
                        <span class="w-1.5 h-1.5 rounded-full {{ $price->change['type'] === 'up' ? 'bg-red-500 shadow-[0_0_6px_rgba(239,68,68,0.8)]' : ($price->change['type'] === 'down' ? 'bg-green-500 shadow-[0_0_6px_rgba(34,197,94,0.8)]' : 'bg-gray-500') }}"></span>
                        <span class="font-medium text-sm text-green-400 drop-shadow-[0_0_8px_rgba(74,222,128,0.6)]">{{ $price->nama_komoditi }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-400">{{ $price->satuan }}</span>
                        <span class="font-bold text-sm text-green-400 tabular-nums drop-shadow-[0_0_8px_rgba(74,222,128,0.6)]">
                            Rp {{ number_format($price->harga, 0, ',', '.') }}
                        </span>
                        @if($price->change['type'] === 'up')
                            <span class="text-xs text-red-400 drop-shadow-[0_0_6px_rgba(248,113,113,0.6)]">▲</span>
                        @elseif($price->change['type'] === 'down')
                            <span class="text-xs text-green-400 drop-shadow-[0_0_6px_rgba(74,222,128,0.6)]">▼</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            {{-- LED Glow Effect Overlay --}}
            <div class="absolute top-0 left-0 right-0 h-10 bg-gradient-to-b from-gray-900 to-transparent pointer-events-none z-10"></div>
            <div class="absolute bottom-0 left-0 right-0 h-10 bg-gradient-to-t from-gray-900 to-transparent pointer-events-none z-10"></div>
        </div>
        @else
        <div class="text-center py-8">
            <p class="text-gray-500 text-sm">Data harga belum tersedia.</p>
        </div>
        @endif
    </div>

    <style>
    @keyframes ticker {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(-50%);
        }
    }

    .animate-ticker {
        animation: ticker 30s linear infinite;
        will-change: transform;
    }
    </style>
</div>
