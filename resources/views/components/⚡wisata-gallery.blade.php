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
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
        <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary">
            Destinasi Wisata
        </h2>
        
        @if(count($kecamatans) > 0)
        <div class="flex flex-wrap gap-2">
            <button wire:click="clearFilter" 
                    class="px-3 py-1.5 text-sm rounded-full transition-colors {{ $selectedKecamatan === null ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Semua
            </button>
            @foreach($kecamatans as $kecamatan)
            <button wire:click="filterByKecamatan('{{ $kecamatan }}')" 
                    class="px-3 py-1.5 text-sm rounded-full transition-colors {{ $selectedKecamatan === $kecamatan ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                {{ $kecamatan }}
            </button>
            @endforeach
        </div>
        @endif
    </div>

    @if($wisatas->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($wisatas as $wisata)
        <article class="group bg-white rounded-card shadow-sm overflow-hidden hover:shadow-lg transition-shadow">
            <a href="{{ url('/wisata/'.$wisata->slug) }}" class="block">
                <div class="aspect-[4/3] overflow-hidden">
                    @if($wisata->getFirstMediaUrl('foto_utama'))
                    <img src="{{ $wisata->getFirstMediaUrl('foto_utama') }}" 
                         alt="{{ $wisata->nama }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-primary/20 to-accent/20 flex items-center justify-center">
                        <svg class="w-16 h-16 text-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    @endif
                </div>
                
                <div class="p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2 py-1 bg-accent/10 text-accent text-xs font-medium rounded">
                            {{ $wisata->kecamatan }}
                        </span>
                    </div>
                    
                    <h3 class="font-heading font-semibold text-lg text-gray-900 mb-2 group-hover:text-accent transition-colors">
                        {{ $wisata->nama }}
                    </h3>
                    
                    <p class="text-gray-600 text-sm line-clamp-2 mb-3">
                        {{ Str::limit(strip_tags($wisata->deskripsi), 100) }}
                    </p>
                    
                    <div class="flex items-center text-gray-500 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $wisata->lokasi }}
                    </div>
                </div>
            </a>
        </article>
        @endforeach
    </div>
    
    <div class="mt-8 text-center">
        <a href="{{ url('/wisata') }}" class="inline-flex items-center px-6 py-3 bg-primary hover:bg-primary-dark text-white font-semibold rounded-button transition-colors">
            Lihat Semua Wisata
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
    @else
    <div class="text-center py-12 bg-gray-50 rounded-card">
        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        <p class="text-gray-500">Belum ada data wisata tersedia.</p>
    </div>
    @endif
</div>
