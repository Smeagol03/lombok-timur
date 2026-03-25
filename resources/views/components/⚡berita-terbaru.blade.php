<?php

use App\Models\Berita;
use App\Models\Kategori;
use Livewire\Component;

new class extends Component
{
    public $featuredNews;

    public $sideNews;

    public $categories;

    public $selectedCategory = null;

    public function mount(): void
    {
        $this->loadNews();
        $this->categories = Kategori::all();
    }

    public function loadNews(): void
    {
        $query = Berita::published();

        if ($this->selectedCategory) {
            $query->where('kategori_id', $this->selectedCategory);
        }

        $allNews = $query->latest('published_at')->take(6)->get();

        $this->featuredNews = $allNews->first();
        $this->sideNews = $allNews->skip(1)->take(5);
    }

    public function filterByCategory($categoryId): void
    {
        $this->selectedCategory = $categoryId;
        $this->loadNews();
    }
};
?>

<div class="w-full">
    <div class="flex flex-wrap items-center justify-between mb-6 gap-4">
        <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary">
            Berita Terbaru
        </h2>
        
        <div class="flex flex-wrap gap-2">
            <button wire:click="filterByCategory(null)" 
                    class="px-3 py-1.5 text-sm rounded-full transition-colors {{ $selectedCategory === null ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Semua
            </button>
            @foreach($categories as $category)
            <button wire:click="filterByCategory({{ $category->id }})" 
                    class="px-3 py-1.5 text-sm rounded-full transition-colors {{ $selectedCategory === $category->id ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                {{ $category->nama }}
            </button>
            @endforeach
        </div>
    </div>

    @if($featuredNews)
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Berita Utama --}}
        <article class="group">
            <a href="{{ url('/berita/'.$featuredNews->slug) }}" class="block">
                <div class="aspect-[16/10] rounded-card overflow-hidden mb-4">
                    @if($featuredNews->getFirstMediaUrl('thumbnail'))
                    <img src="{{ $featuredNews->getFirstMediaUrl('thumbnail') }}" 
                         alt="{{ $featuredNews->judul }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @endif
                </div>
                
                <div class="flex items-center gap-3 mb-3">
                    <span class="px-3 py-1 text-xs font-medium rounded-full" style="background-color: {{ $featuredNews->kategori->warna ?? '#1B3B6F' }}20; color: {{ $featuredNews->kategori->warna ?? '#1B3B6F' }}">
                        {{ $featuredNews->kategori->nama ?? 'Umum' }}
                    </span>
                    <span class="text-gray-500 text-sm">
                        {{ $featuredNews->published_at->format('d M Y') }}
                    </span>
                </div>
                
                <h3 class="font-heading text-xl md:text-2xl font-bold text-gray-900 mb-3 group-hover:text-accent transition-colors line-clamp-2">
                    {{ $featuredNews->judul }}
                </h3>
                
                <p class="text-gray-600 line-clamp-3">
                    {{ Str::limit(strip_tags($featuredNews->excerpt ?? $featuredNews->konten), 200) }}
                </p>
            </a>
        </article>

        {{-- Berita Sampingan --}}
        <div class="flex flex-col gap-4">
            @foreach($sideNews as $news)
            <article class="group flex gap-4">
                <a href="{{ url('/berita/'.$news->slug) }}" class="block flex-shrink-0">
                    <div class="w-24 h-24 md:w-32 md:h-32 rounded-lg overflow-hidden">
                        @if($news->getFirstMediaUrl('thumbnail'))
                        <img src="{{ $news->getFirstMediaUrl('thumbnail') }}" 
                             alt="{{ $news->judul }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @endif
                    </div>
                </a>
                
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2 py-0.5 text-xs font-medium rounded" style="background-color: {{ $news->kategori->warna ?? '#1B3B6F' }}20; color: {{ $news->kategori->warna ?? '#1B3B6F' }}">
                            {{ $news->kategori->nama ?? 'Umum' }}
                        </span>
                        <span class="text-gray-400 text-xs">
                            {{ $news->published_at->format('d M') }}
                        </span>
                    </div>
                    
                    <a href="{{ url('/berita/'.$news->slug) }}">
                        <h4 class="font-heading font-semibold text-gray-900 group-hover:text-accent transition-colors line-clamp-2">
                            {{ $news->judul }}
                        </h4>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
    @else
    <div class="text-center py-12">
        <p class="text-gray-500">Belum ada berita tersedia.</p>
    </div>
    @endif

    <div class="mt-8 text-center">
        <a href="{{ url('/berita') }}" class="inline-flex items-center px-6 py-3 border-2 border-primary text-primary font-semibold rounded-button hover:bg-primary hover:text-white transition-colors">
            Lihat Semua Berita
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</div>
