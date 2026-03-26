<?php

use App\Models\Wisata;
use Livewire\Component;

new class extends Component
{
    public $wisatas;

    public $kecamatans = [];

    public $selectedKecamatan = null;

    public function mount(): void
    {
        $this->kecamatans = Wisata::distinct()->pluck('kecamatan')->toArray();
        $this->loadWisatas();
    }

    public function loadWisatas(): void
    {
        $query = Wisata::query();

        if ($this->selectedKecamatan) {
            $query->where('kecamatan', $this->selectedKecamatan);
        }

        $this->wisatas = $query->latest()->take(6)->get();
    }

    public function filterByKecamatan($kecamatan): void
    {
        $this->selectedKecamatan = $kecamatan;
        $this->loadWisatas();
    }

    public function clearFilter(): void
    {
        $this->selectedKecamatan = null;
        $this->loadWisatas();
    }
};
?>

<div class="w-full">
    {{-- Header with Filter --}}
    <div class="flex flex-col gap-4 mb-6 sm:mb-8">
        <h2 class="font-heading text-xl sm:text-2xl md:text-3xl font-bold text-primary">
            Destinasi Wisata
        </h2>
        
        @if(count($kecamatans) > 0)
        {{-- Filter Pills - Scrollable on mobile --}}
        <div class="flex gap-2 overflow-x-auto pb-2 -mx-4 px-4 sm:mx-0 sm:px-0 scrollbar-hide">
            <button wire:click="clearFilter" 
                    class="flex-shrink-0 px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm rounded-full transition-colors whitespace-nowrap {{ $selectedKecamatan === null ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Semua
            </button>
            @foreach($kecamatans as $kecamatan)
            <button wire:click="filterByKecamatan('{{ $kecamatan }}')" 
                    class="flex-shrink-0 px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm rounded-full transition-colors whitespace-nowrap {{ $selectedKecamatan === $kecamatan ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                {{ $kecamatan }}
            </button>
            @endforeach
        </div>
        @endif
    </div>

    @if($wisatas->count() > 0)
    {{-- Cards Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5 md:gap-6">
        @foreach($wisatas as $wisata)
        <article class="group bg-white rounded-xl sm:rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-shadow border border-gray-100">
            <a href="{{ url('/wisata/'.$wisata->slug) }}" class="block">
                <div class="aspect-[4/3] overflow-hidden relative">
                    @if($wisata->getFirstMediaUrl('foto_utama'))
                    <img src="{{ $wisata->getFirstMediaUrl('foto_utama') }}" 
                         alt="{{ $wisata->nama }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-primary/20 to-accent/20 flex items-center justify-center">
                        <svg class="w-12 h-12 sm:w-16 sm:h-16 text-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    @endif
                    
                    {{-- Kecamatan Badge --}}
                    <div class="absolute top-2 sm:top-3 left-2 sm:left-3">
                        <span class="px-2 sm:px-2.5 py-0.5 sm:py-1 bg-black/60 backdrop-blur-sm text-white text-[10px] sm:text-xs font-medium rounded">
                            {{ $wisata->kecamatan }}
                        </span>
                    </div>
                </div>
                
                <div class="p-3 sm:p-4">
                    <h3 class="font-heading font-semibold text-sm sm:text-base md:text-lg text-gray-900 mb-1.5 sm:mb-2 group-hover:text-accent transition-colors line-clamp-2 leading-tight">
                        {{ $wisata->nama }}
                    </h3>
                    
                    <div class="flex items-center gap-1 text-gray-500 text-xs sm:text-sm mb-2 sm:mb-3">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="line-clamp-1">{{ $wisata->lokasi }}</span>
                    </div>
                    
                    <p class="text-gray-600 text-xs sm:text-sm line-clamp-2 mb-2 sm:mb-3">
                        {{ Str::limit(strip_tags($wisata->deskripsi), 80) }}
                    </p>
                    
                    <div class="flex items-center text-primary font-medium text-xs sm:text-sm">
                        Lihat detail
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
        </article>
        @endforeach
    </div>
    
    <div class="mt-6 sm:mt-8 text-center">
        <a href="{{ url('/wisata') }}" class="inline-flex items-center px-4 sm:px-6 py-2.5 sm:py-3 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg transition-colors text-sm sm:text-base">
            Lihat Semua Wisata
            <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-1.5 sm:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
    @else
    <div class="text-center py-8 sm:py-12 bg-gray-50 rounded-xl sm:rounded-2xl">
        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        <p class="text-gray-500 text-sm sm:text-base">Belum ada data wisata tersedia.</p>
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