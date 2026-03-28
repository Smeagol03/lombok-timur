<?php

use App\Models\Berita;
use App\Models\Kategori;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public $categories;

    public $selectedCategory = null;

    public $search = '';

    protected $queryString = [
        'selectedCategory' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    public function mount(): void
    {
        $this->categories = Kategori::all();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedSelectedCategory(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function beritas()
    {
        $query = Berita::published()->with(['kategori', 'penulis']);

        if ($this->selectedCategory) {
            $query->where('kategori_id', $this->selectedCategory);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('judul', 'like', '%'.$this->search.'%')
                    ->orWhere('excerpt', 'like', '%'.$this->search.'%');
            });
        }

        return $query->latest('published_at')->paginate(9);
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
                           placeholder="Cari berita..." 
                           class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
            
            {{-- Category Filter --}}
            <div class="md:w-64">
                <select wire:model.live="selectedCategory" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        {{-- Active Filters --}}
        @if($selectedCategory || $search)
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
            @if($selectedCategory)
            @php $category = $categories->firstWhere('id', $selectedCategory); @endphp
            <span class="inline-flex items-center px-3 py-1 bg-accent/10 text-accent text-sm rounded-full">
                Kategori: {{ $category?->nama }}
                <button wire:click="$set('selectedCategory', '')" class="ml-2 hover:text-red-500">
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
            Menampilkan {{ $this->beritas->firstItem() ?? 0 }} - {{ $this->beritas->lastItem() ?? 0 }} dari {{ $this->beritas->total() }} berita
        </p>
    </div>

    {{-- News Grid --}}
    @if($this->beritas->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($this->beritas as $berita)
        <article class="bg-white rounded-card shadow-sm overflow-hidden hover:shadow-md transition-shadow border border-gray-100">
            <a href="{{ url('/berita/'.$berita->slug) }}" class="block">
                <div class="aspect-video overflow-hidden bg-gray-200">
                    @if($berita->getFirstMediaUrl('thumbnail'))
                    <img src="{{ $berita->getFirstMediaUrl('thumbnail') }}" 
                         alt="{{ $berita->judul }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    @else
                    <img src="https://picsum.photos/600/340?random={{ $berita->id }}" 
                         alt="{{ $berita->judul }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    @endif
                </div>
            </a>
            
            <div class="p-5">
                <div class="flex items-center gap-3 mb-3">
                    <span class="px-2 py-1 text-xs font-medium rounded" style="background-color: {{ $berita->kategori->warna ?? '#1B3B6F' }}20; color: {{ $berita->kategori->warna ?? '#1B3B6F' }}">
                        {{ $berita->kategori->nama ?? 'Umum' }}
                    </span>
                    <span class="text-gray-400 text-sm">
                        {{ $berita->published_at->format('d M Y') }}
                    </span>
                </div>
                
                <a href="{{ url('/berita/'.$berita->slug) }}">
                    <h3 class="font-heading font-semibold text-lg text-gray-900 mb-2 hover:text-accent transition-colors line-clamp-2">
                        {{ $berita->judul }}
                    </h3>
                </a>
                
                <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                    {{ Str::limit(strip_tags($berita->excerpt ?? $berita->konten), 120) }}
                </p>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        {{ number_format($berita->views) }} views
                    </div>
                    <a href="{{ url('/berita/'.$berita->slug) }}" class="text-primary hover:text-accent text-sm font-medium">
                        Baca selengkapnya →
                    </a>
                </div>
            </div>
        </article>
        @endforeach
    </div>
    
    {{-- Pagination --}}
    <div class="mt-8">
        {{ $this->beritas->links() }}
    </div>
    @else
    <div class="text-center py-16 bg-gray-50 rounded-card">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada berita</h3>
        <p class="text-gray-500">Tidak ditemukan berita dengan filter yang dipilih.</p>
    </div>
    @endif
</div>
