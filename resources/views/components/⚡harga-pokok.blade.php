<?php

use App\Models\HargaPokok;
use Livewire\Component;

new class extends Component
{
    public $prices;

    public $lastUpdate;

    public function mount(): void
    {
        $this->loadPrices();
    }

    public function loadPrices(): void
    {
        $this->prices = HargaPokok::latest('tanggal_update')
            ->take(10)
            ->get();

        $this->lastUpdate = HargaPokok::latest('tanggal_update')->value('tanggal_update');
    }

    public function getPriceChange($komoditiId)
    {
        $current = HargaPokok::find($komoditiId);
        $previous = HargaPokok::where('nama_komoditi', $current->nama_komoditi)
            ->where('tanggal_update', '<', $current->tanggal_update)
            ->latest('tanggal_update')
            ->first();

        if (! $previous) {
            return ['type' => 'same', 'value' => 0];
        }

        $diff = $current->harga - $previous->harga;

        if ($diff > 0) {
            return ['type' => 'up', 'value' => $diff];
        } elseif ($diff < 0) {
            return ['type' => 'down', 'value' => abs($diff)];
        }

        return ['type' => 'same', 'value' => 0];
    }
};
?>

<div class="w-full">
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-4 sm:mb-6 gap-2 sm:gap-4">
        <div>
            <h2 class="font-heading text-xl sm:text-2xl md:text-3xl font-bold text-primary">
                Harga Bahan Pokok
            </h2>
            @if($lastUpdate)
            <p class="text-xs sm:text-sm text-gray-500 mt-1">
                Update: {{ $lastUpdate->format('d M Y') }}
            </p>
            @endif
        </div>
        <a href="{{ url('/data/harga-pokok') }}" class="text-primary hover:text-accent font-medium text-xs sm:text-sm self-start sm:self-auto">
            Selengkapnya →
        </a>
    </div>

    <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if($prices->count() > 0)
        <div class="overflow-x-auto -mx-4 sm:mx-0">
            <div class="min-w-full inline-block align-middle">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 sm:px-4 py-2.5 sm:py-3 text-left text-[10px] sm:text-xs font-semibold text-gray-500 uppercase tracking-wider">Komoditi</th>
                            <th class="px-3 sm:px-4 py-2.5 sm:py-3 text-left text-[10px] sm:text-xs font-semibold text-gray-500 uppercase tracking-wider hidden sm:table-cell">Satuan</th>
                            <th class="px-3 sm:px-4 py-2.5 sm:py-3 text-right text-[10px] sm:text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga</th>
                            <th class="px-3 sm:px-4 py-2.5 sm:py-3 text-center text-[10px] sm:text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($prices as $price)
                        @php
                        $change = $this->getPriceChange($price->id);
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-3 sm:px-4 py-2.5 sm:py-3">
                                <div>
                                    <span class="font-medium text-gray-900 text-xs sm:text-sm">{{ $price->nama_komoditi }}</span>
                                    <span class="text-gray-400 text-[10px] sm:hidden ml-1">({{ $price->satuan }})</span>
                                </div>
                            </td>
                            <td class="px-3 sm:px-4 py-2.5 sm:py-3 text-gray-600 text-xs sm:text-sm hidden sm:table-cell">{{ $price->satuan }}</td>
                            <td class="px-3 sm:px-4 py-2.5 sm:py-3 text-right font-semibold text-gray-900 text-xs sm:text-sm tabular-nums">
                                Rp {{ number_format($price->harga, 0, ',', '.') }}
                            </td>
                            <td class="px-3 sm:px-4 py-2.5 sm:py-3 text-center">
                                @if($change['type'] === 'up')
                                    <span class="inline-flex items-center px-1.5 sm:px-2 py-0.5 sm:py-1 rounded text-[10px] sm:text-xs font-medium bg-red-100 text-red-700">
                                        <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 mr-0.5 sm:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                                        </svg>
                                        <span class="hidden sm:inline">+</span>{{ number_format($change['value'], 0, ',', '.') }}
                                    </span>
                                @elseif($change['type'] === 'down')
                                    <span class="inline-flex items-center px-1.5 sm:px-2 py-0.5 sm:py-1 rounded text-[10px] sm:text-xs font-medium bg-green-100 text-green-700">
                                        <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 mr-0.5 sm:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                        </svg>
                                        -{{ number_format($change['value'], 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center justify-center w-5 h-5 sm:w-6 sm:h-6 rounded text-[10px] sm:text-xs font-medium bg-gray-100 text-gray-600">
                                        -
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="text-center py-8 sm:py-12">
            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-gray-500 text-sm sm:text-base">Data harga belum tersedia.</p>
        </div>
        @endif
    </div>
</div>