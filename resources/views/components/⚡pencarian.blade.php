<?php

use App\Models\Berita;
use App\Models\Layanan;
use App\Models\Pengumuman;
use App\Models\Wisata;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public $search = '';

    public $type = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'type' => ['except' => 'all'],
    ];

    public function updatedSearch(): void
    {
        $this->dispatch('search-updated');
    }

    public function updatedType(): void
    {
        $this->dispatch('type-updated');
    }

    #[Computed]
    public function results()
    {
        if (empty($this->search)) {
            return collect();
        }

        $results = collect();

        // Search Berita
        if ($this->type === 'all' || $this->type === 'berita') {
            $beritas = Berita::search($this->search)
                ->take(10)
                ->get();
            $beritas->load('media');

            foreach ($beritas as $item) {
                $results->push([
                    'id' => $item->id,
                    'type' => 'berita',
                    'title' => $item->judul,
                    'excerpt' => Str::limit(strip_tags($item->excerpt ?? $item->konten), 120),
                    'url' => url('/berita/'.$item->slug),
                    'date' => $item->published_at,
                    'image' => $item->getFirstMediaUrl('thumbnail'),
                ]);
            }
        }

        // Search Pengumuman
        if ($this->type === 'all' || $this->type === 'pengumuman') {
            $pengumumen = Pengumuman::search($this->search)
                ->take(10)
                ->get();
            $pengumumen->load('media');

            foreach ($pengumumen as $item) {
                $results->push([
                    'id' => $item->id,
                    'type' => 'pengumuman',
                    'title' => $item->judul,
                    'excerpt' => Str::limit(strip_tags($item->konten), 120),
                    'url' => url('/pengumuman/'.$item->slug),
                    'date' => $item->tanggal_terbit,
                    'image' => null,
                ]);
            }
        }

        // Search Layanan
        if ($this->type === 'all' || $this->type === 'layanan') {
            $layanans = Layanan::search($this->search)
                ->take(10)
                ->get();
            $layanans->load('media');

            foreach ($layanans as $item) {
                $results->push([
                    'id' => $item->id,
                    'type' => 'layanan',
                    'title' => $item->nama,
                    'excerpt' => Str::limit(strip_tags($item->deskripsi), 120),
                    'url' => url('/layanan/'.$item->slug),
                    'date' => null,
                    'image' => $item->getFirstMediaUrl('icon'),
                ]);
            }
        }

        // Search Wisata
        if ($this->type === 'all' || $this->type === 'wisata') {
            $wisatas = Wisata::search($this->search)
                ->take(10)
                ->get();
            $wisatas->load('media');

            foreach ($wisatas as $item) {
                $results->push([
                    'id' => $item->id,
                    'type' => 'wisata',
                    'title' => $item->nama,
                    'excerpt' => Str::limit(strip_tags($item->deskripsi), 120),
                    'url' => url('/wisata/'.$item->slug),
                    'date' => null,
                    'image' => $item->getFirstMediaUrl('foto_utama'),
                ]);
            }
        }

        return $results->sortByDesc('date')->values();
    }

    public function getTypeLabel(string $type): string
    {
        return match ($type) {
            'berita' => 'Berita',
            'pengumuman' => 'Pengumuman',
            'layanan' => 'Layanan',
            'wisata' => 'Wisata',
            default => 'Umum',
        };
    }

    public function getTypeColor(string $type): string
    {
        return match ($type) {
            'berita' => 'bg-blue-100 text-blue-700',
            'pengumuman' => 'bg-red-100 text-red-700',
            'layanan' => 'bg-green-100 text-green-700',
            'wisata' => 'bg-purple-100 text-purple-700',
            default => 'bg-gray-100 text-gray-700',
        };
    }
};
?>

<div class="w-full">
    {{-- Search Section --}}
    <div class="bg-white rounded-card p-6 mb-8 shadow-sm">
        <div class="relative mb-4">
            <input wire:model.live.debounce.500ms="search" 
                   type="text" 
                   placeholder="Cari informasi..." 
                   class="w-full pl-12 pr-4 py-4 text-lg border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            <svg class="w-6 h-6 text-gray-400 absolute left-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        
        {{-- Type Filter --}}
        <div class="flex flex-wrap gap-2">
            <button wire:click="$set('type', 'all')" 
                    class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ $type === 'all' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Semua
            </button>
            <button wire:click="$set('type', 'berita')" 
                    class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ $type === 'berita' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Berita
            </button>
            <button wire:click="$set('type', 'pengumuman')" 
                    class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ $type === 'pengumuman' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Pengumuman
            </button>
            <button wire:click="$set('type', 'layanan')" 
                    class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ $type === 'layanan' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Layanan
            </button>
            <button wire:click="$set('type', 'wisata')" 
                    class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ $type === 'wisata' ? 'bg-purple-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Wisata
            </button>
        </div>
    </div>

    {{-- Results --}}
    @if(empty($search))
    <div class="text-center py-16">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Cari Informasi</h3>
        <p class="text-gray-500">Masukkan kata kunci untuk mencari berita, pengumuman, layanan, atau wisata.</p>
    </div>
    @elseif($this->results->count() === 0)
    <div class="text-center py-16 bg-gray-50 rounded-card">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ditemukan</h3>
        <p class="text-gray-500">Tidak ada hasil untuk "{{ $search }}". Coba kata kunci lain.</p>
    </div>
    @else
    <div class="mb-6">
        <p class="text-gray-600">
            Ditemukan {{ $this->results->count() }} hasil untuk "{{ $search }}"
        </p>
    </div>

    <div class="space-y-4">
        @foreach($this->results as $result)
        <article class="bg-white rounded-card shadow-sm overflow-hidden hover:shadow-md transition-shadow border border-gray-100">
            <a href="{{ $result['url'] }}" class="block p-6">
                <div class="flex items-start gap-4">
                    {{-- Image --}}
                    <div class="flex-shrink-0 w-20 h-20 bg-gray-100 rounded-lg overflow-hidden">
                        @if($result['image'])
                        <img src="{{ $result['image'] }}" 
                             alt="{{ $result['title'] }}"
                             class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @endif
                    </div>
                    
                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-2 py-0.5 text-xs font-medium rounded {{ $this->getTypeColor($result['type']) }}">
                                {{ $this->getTypeLabel($result['type']) }}
                            </span>
                            @if($result['date'])
                            <span class="text-gray-400 text-sm">
                                {{ $result['date']->format('d M Y') }}
                            </span>
                            @endif
                        </div>
                        
                        <h3 class="font-heading font-semibold text-lg text-gray-900 hover:text-accent transition-colors line-clamp-1">
                            {{ $result['title'] }}
                        </h3>
                        
                        <p class="text-gray-600 text-sm line-clamp-2 mt-1">
                            {{ $result['excerpt'] }}
                        </p>
                    </div>
                    
                    {{-- Arrow --}}
                    <div class="flex-shrink-0 hidden md:block">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
        </article>
        @endforeach
    </div>
    @endif
</div>