<?php

use App\Models\HargaPokok;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    #[Computed]
    public function prices()
    {
        return HargaPokok::latest('tanggal_update')
            ->take(10)
            ->get();
    }

    #[Computed]
    public function lastUpdate()
    {
        return HargaPokok::latest('tanggal_update')->value('tanggal_update');
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

<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4">
        <div>
            <h2 class="font-heading text-lg md:text-xl font-bold text-primary">Harga Bahan Pokok</h2>
            @if($this->lastUpdate)
            <p class="text-xs text-gray-500">Update: {{ $this->lastUpdate->format('d M Y') }}</p>
            @endif
        </div>
        <a href="{{ url('/data/harga-pokok') }}" class="text-xs font-medium text-primary hover:text-primary-dark flex items-center gap-1">
            Selengkapnya
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
        @if($this->prices->count() > 0)
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Komoditi</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden sm:table-cell">Satuan</th>
                    <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($this->prices as $price)
                @php
                $change = $this->getPriceChange($price->id);
                @endphp
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-4 py-3">
                        <span class="font-medium text-sm text-gray-900">{{ $price->nama_komoditi }}</span>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-600 hidden sm:table-cell">{{ $price->satuan }}</td>
                    <td class="px-4 py-3 text-right font-semibold text-gray-900 text-sm tabular-nums">
                        Rp {{ number_format($price->harga, 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        @if($change['type'] === 'up')
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-red-100 text-red-700">
                                +{{ number_format($change['value'], 0, ',', '.') }}
                            </span>
                        @elseif($change['type'] === 'down')
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-green-100 text-green-700">
                                -{{ number_format($change['value'], 0, ',', '.') }}
                            </span>
                        @else
                            <span class="text-gray-400 text-xs">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="text-center py-8">
            <p class="text-gray-500 text-sm">Data harga belum tersedia.</p>
        </div>
        @endif
    </div>
</div>