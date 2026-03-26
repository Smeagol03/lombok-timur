<?php

use App\Models\StokDarah;
use Livewire\Component;

new class extends Component
{
    public $stocks;

    public $lastUpdate;

    public function mount(): void
    {
        $this->loadStocks();
    }

    public function loadStocks(): void
    {
        $this->stocks = StokDarah::latest('tanggal_update')->get();
        $this->lastUpdate = StokDarah::latest('tanggal_update')->value('tanggal_update');
    }

    public function getStatusColor($jumlah)
    {
        if ($jumlah >= 100) {
            return 'bg-green-500';
        }
        if ($jumlah >= 50) {
            return 'bg-yellow-500';
        }

        return 'bg-red-500';
    }

    public function getStatusText($jumlah)
    {
        if ($jumlah >= 100) {
            return 'Aman';
        }
        if ($jumlah >= 50) {
            return 'Sedang';
        }

        return 'Kritis';
    }
};
?>

<div class="w-full">
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-4 sm:mb-6 gap-2 sm:gap-4">
        <div>
            <h2 class="font-heading text-xl sm:text-2xl md:text-3xl font-bold text-primary">
                Stok Darah PMI
            </h2>
            @if($lastUpdate)
            <p class="text-xs sm:text-sm text-gray-500 mt-1">
                Update: {{ $lastUpdate->format('d M Y') }}
            </p>
            @endif
        </div>
        <a href="{{ url('/data/stok-darah') }}" class="text-primary hover:text-accent font-medium text-xs sm:text-sm self-start sm:self-auto">
            Detail Stok →
        </a>
    </div>

    @if($stocks->count() > 0)
    {{-- Cards Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-3 md:gap-4">
        @foreach($stocks as $stock)
        <div class="bg-white rounded-xl sm:rounded-2xl p-3 sm:p-4 md:p-5 shadow-sm border border-gray-100 text-center hover:shadow-md transition-shadow">
            {{-- Blood Type Badge --}}
            <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 mx-auto mb-2 sm:mb-3 rounded-full flex items-center justify-center text-white text-base sm:text-lg md:text-xl font-bold {{ $this->getStatusColor($stock->jumlah) }}">
                {{ $stock->golongan }}
            </div>
            
            {{-- Stock Count --}}
            <div class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900 mb-0.5 sm:mb-1 tabular-nums">
                {{ $stock->jumlah }}
            </div>
            <div class="text-[10px] sm:text-xs text-gray-500 mb-1.5 sm:mb-2">Kantong</div>
            
            {{-- Status Badge --}}
            <span class="inline-flex items-center px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-full text-[10px] sm:text-xs font-medium {{ $stock->jumlah >= 100 ? 'bg-green-100 text-green-700' : ($stock->jumlah >= 50 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                {{ $this->getStatusText($stock->jumlah) }}
            </span>
        </div>
        @endforeach
    </div>
    
    {{-- Legend --}}
    <div class="mt-4 sm:mt-6 flex flex-wrap items-center justify-center gap-3 sm:gap-4 text-xs sm:text-sm">
        <div class="flex items-center gap-1.5 sm:gap-2">
            <span class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-green-500"></span>
            <span class="text-gray-600">Aman (>100)</span>
        </div>
        <div class="flex items-center gap-1.5 sm:gap-2">
            <span class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-yellow-500"></span>
            <span class="text-gray-600">Sedang (50-100)</span>
        </div>
        <div class="flex items-center gap-1.5 sm:gap-2">
            <span class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-red-500"></span>
            <span class="text-gray-600">Kritis (<50)</span>
        </div>
    </div>
    @else
    <div class="text-center py-8 sm:py-12 bg-gray-50 rounded-xl sm:rounded-2xl">
        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
        </svg>
        <p class="text-gray-500 text-sm sm:text-base">Data stok darah belum tersedia.</p>
    </div>
    @endif
</div>