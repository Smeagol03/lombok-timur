<?php

use App\Models\StokDarah;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    #[Computed]
    public function stocks()
    {
        return StokDarah::latest("tanggal_update")->get();
    }

    #[Computed]
    public function lastUpdate()
    {
        return StokDarah::latest("tanggal_update")->value("tanggal_update");
    }

    public function getStatusColor($jumlah)
    {
        if ($jumlah >= 100) {
            return "bg-green-500";
        }
        if ($jumlah >= 50) {
            return "bg-yellow-500";
        }

        return "bg-red-500";
    }

    public function getStatusText($jumlah)
    {
        if ($jumlah >= 100) {
            return "Aman";
        }
        if ($jumlah >= 50) {
            return "Sedang";
        }

        return "Kritis";
    }
};
?>

<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4">
        <div>
            <h2 class="font-heading text-lg md:text-xl font-bold text-primary">Stok Darah PMI</h2>
            @if($this->lastUpdate)
            <p class="text-xs text-gray-500">Update: {{ $this->lastUpdate->format('d M Y') }}</p>
            @endif
        </div>
    </div>

    @if($this->stocks->count() > 0)
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
        @foreach($this->stocks as $stock)
        <div class="bg-white border border-gray-200 rounded-lg p-3 sm:p-4 text-center hover:shadow-md transition-shadow">
            <div class="w-10 h-10 sm:w-12 sm:h-12 mx-auto mb-2 rounded-full flex items-center justify-center text-white text-base sm:text-lg font-bold {{ $this->getStatusColor($stock->jumlah) }}">
                {{ $stock->golongan }}
            </div>
            <div class="text-lg sm:text-xl font-bold text-gray-900">{{ $stock->jumlah }}</div>
            <div class="text-xs text-gray-500 mb-2">kantong</div>
            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] sm:text-xs font-medium {{ $stock->jumlah >= 100 ? 'bg-green-100 text-green-700' : ($stock->jumlah >= 50 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                {{ $this->getStatusText($stock->jumlah) }}
            </span>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-8 bg-gray-50 rounded-lg">
        <p class="text-gray-500 text-sm">Data stok darah belum tersedia.</p>
    </div>
    @endif
</div>
