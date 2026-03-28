<?php

use App\Models\Wisata;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public $selectedKecamatan = null;

    #[Computed]
    public function kecamatans()
    {
        return Wisata::distinct()->pluck('kecamatan')->toArray();
    }

    #[Computed]
    public function wisatas()
    {
        $query = Wisata::query()->with('media');

        if ($this->selectedKecamatan) {
            $query->where('kecamatan', $this->selectedKecamatan);
        }

        return $query->latest()->take(6)->get();
    }

    public function filterByKecamatan($kecamatan): void
    {
        $this->selectedKecamatan = $kecamatan;
    }

    public function clearFilter(): void
    {
        $this->selectedKecamatan = null;
    }
};
?>

<div>
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="font-heading text-xl md:text-2xl font-bold text-primary">Destinasi Wisata</h2>
            <p class="text-sm text-gray-500 mt-0.5">Tempat wisata menarik di Lombok Timur</p>
        </div>
        <a href="{{ url('/wisata') }}" class="text-sm font-medium text-primary hover:text-primary-dark flex items-center gap-1">
            Lihat Semua
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
    
    {{-- Filter Pills --}}
    @if(count($this->kecamatans) > 0)
    <div class="flex gap-2 overflow-x-auto pb-2 -mx-4 px-4 sm:mx-0 sm:px-0 scrollbar-hide mb-6">
        <button wire:click="clearFilter" 
                class="flex-shrink-0 px-3 py-1.5 text-xs font-medium rounded-md transition-colors whitespace-nowrap {{ $selectedKecamatan === null ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            Semua
        </button>
        @foreach($this->kecamatans as $kecamatan)
        <button wire:click="filterByKecamatan('{{ $kecamatan }}')" 
                class="flex-shrink-0 px-3 py-1.5 text-xs font-medium rounded-md transition-colors whitespace-nowrap {{ $selectedKecamatan === $kecamatan ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            {{ $kecamatan }}
        </button>
        @endforeach
    </div>
    @endif

    @if($this->wisatas->count() > 0)
    {{-- Cards Grid --}}
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($this->wisatas as $wisata)
        <article class="group bg-white border border-gray-200 rounded-lg overflow-hidden hover:border-primary/30 transition-colors">
            <a href="{{ url('/wisata/'.$wisata->slug) }}" class="block">
                <div class="aspect-[4/3] bg-gray-100 relative overflow-hidden">
                    @if($wisata->getFirstMediaUrl('foto_utama'))
                    <img src="{{ $wisata->getFirstMediaUrl('foto_utama') }}" 
                         alt="{{ $wisata->nama }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <img src="https://picsum.photos/600/450?random={{ $wisata->id }}" 
                         alt="{{ $wisata->nama }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @endif
                    <div class="absolute top-2 left-2">
                        <span class="px-2 py-0.5 bg-black/60 text-white text-[10px] font-medium rounded">
                            {{ $wisata->kecamatan }}
                        </span>
                    </div>
                </div>
                
                <div class="p-4">
                    <h3 class="font-heading font-semibold text-sm text-gray-900 group-hover:text-primary transition-colors line-clamp-1">
                        {{ $wisata->nama }}
                    </h3>
                    <p class="text-xs text-gray-500 mt-1 line-clamp-1">
                        {{ $wisata->lokasi }}
                    </p>
                </div>
            </a>
        </article>
        @endforeach
    </div>
    @else
    <div class="text-center py-12 bg-gray-50 rounded-lg">
        <p class="text-gray-500 text-sm">Belum ada data wisata tersedia.</p>
    </div>
    @endif
</div>

<style>
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
</style>