<?php

use App\Models\Wisata;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public $search = '';

    public $selectedKecamatan = '';

    public $kecamatanList = [
        'Aikmel',
        'Jerowaru',
        'Keruak',
        'Labuhan Haji',
        'Masbagik',
        'Montong Gading',
        'Pringgabaya',
        'Pringgasela',
        'Sakra',
        'Sakra Barat',
        'Sakra Timur',
        'Sambalia',
        'Selong',
        'Sembalun',
        'Sikur',
        'Suel',
        'Sukamulia',
        'Terara',
        'Wanasaba',
    ];

    protected $queryString = [
        'selectedKecamatan' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    public function updatedSearch(): void
    {
        $this->dispatch('search-updated');
    }

    public function updatedSelectedKecamatan(): void
    {
        $this->dispatch('kecamatan-updated');
    }

    #[Computed]
    public function wisatas()
    {
        $query = Wisata::query()->with('media');

        if ($this->selectedKecamatan) {
            $query->byKecamatan($this->selectedKecamatan);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama', 'like', '%'.$this->search.'%')
                    ->orWhere('deskripsi', 'like', '%'.$this->search.'%')
                    ->orWhere('lokasi', 'like', '%'.$this->search.'%');
            });
        }

        return $query->latest()->get();
    }
};
?>

<div class="w-full">
    {{-- Filter Section --}}
    <div class="bg-white rounded-card p-6 mb-8 shadow-sm">
        <div class="flex flex-col md:flex-row gap-4">
            {{-- Search --}}
            <div class="flex-1">
                <div class="relative">
                    <input wire:model.live.debounce.300ms="search" 
                           type="text" 
                           placeholder="Cari destinasi wisata..." 
                           class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
            
            {{-- Kecamatan Filter --}}
            <div class="md:w-64">
                <select wire:model.live="selectedKecamatan" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white">
                    <option value="">Semua Kecamatan</option>
                    @foreach($kecamatanList as $kecamatan)
                    <option value="{{ $kecamatan }}">{{ $kecamatan }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        {{-- Active Filters --}}
        @if($selectedKecamatan || $search)
        <div class="flex flex-wrap items-center gap-2 mt-4 pt-4 border-t border-gray-100">
            <span class="text-sm text-gray-500">Filter aktif:</span>
            @if($search)
            <span class="inline-flex items-center px-3 py-1 bg-primary/10 text-primary text-sm rounded-full">
                Pencarian: {{ $search }}
                <button wire:click="$set('search', '')" class="ml-2 hover:text-red-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </span>
            @endif
            @if($selectedKecamatan)
            <span class="inline-flex items-center px-3 py-1 bg-accent/10 text-accent text-sm rounded-full">
                Kecamatan: {{ $selectedKecamatan }}
                <button wire:click="$set('selectedKecamatan', '')" class="ml-2 hover:text-red-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </span>
            @endif
        </div>
        @endif
    </div>

    {{-- Results Count --}}
    <div class="mb-6">
        <p class="text-gray-600">
            Menampilkan {{ $this->wisatas->count() }} destinasi wisata
        </p>
    </div>

    {{-- Tourism Grid --}}
    @if($this->wisatas->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($this->wisatas as $wisata)
        <article class="bg-white rounded-card shadow-sm overflow-hidden hover:shadow-md transition-shadow border border-gray-100">
            <a href="{{ url('/wisata/'.$wisata->slug) }}" class="block">
                <div class="aspect-video overflow-hidden bg-gray-200 relative">
                    @if($wisata->getFirstMediaUrl('foto_utama'))
                    <img src="{{ $wisata->getFirstMediaUrl('foto_utama') }}" 
                         alt="{{ $wisata->nama }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @endif
                    
                    {{-- Kecamatan Badge --}}
                    <div class="absolute top-3 left-3">
                        <span class="px-2 py-1 text-xs font-medium bg-black/50 text-white rounded backdrop-blur-sm">
                            {{ $wisata->kecamatan }}
                        </span>
                    </div>
                </div>
            </a>
            
            <div class="p-5">
                <a href="{{ url('/wisata/'.$wisata->slug) }}">
                    <h3 class="font-heading font-semibold text-lg text-gray-900 mb-2 hover:text-accent transition-colors">
                        {{ $wisata->nama }}
                    </h3>
                </a>
                
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="line-clamp-1">{{ $wisata->lokasi }}</span>
                </div>
                
                <p class="text-gray-600 text-sm line-clamp-2">
                    {{ Str::limit(strip_tags($wisata->deskripsi), 100) }}
                </p>
                
                <a href="{{ url('/wisata/'.$wisata->slug) }}" class="mt-4 inline-flex items-center text-primary hover:text-accent text-sm font-medium">
                    Lihat detail
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </article>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 bg-gray-50 rounded-card">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada destinasi wisata</h3>
        <p class="text-gray-500">Tidak ditemukan destinasi wisata dengan filter yang dipilih.</p>
    </div>
    @endif
</div>