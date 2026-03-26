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
    {{-- Header with Category Filter --}}
    <div class="flex flex-col gap-4 mb-6 sm:mb-8">
        <h2 class="font-heading text-xl sm:text-2xl md:text-3xl font-bold text-primary">
            Berita Terbaru
        </h2>
        
        {{-- Category Pills - Scrollable on mobile --}}
        <div class="flex gap-2 overflow-x-auto pb-2 -mx-4 px-4 sm:mx-0 sm:px-0 scrollbar-hide">
            <button wire:click="filterByCategory(null)" 
                    class="flex-shrink-0 px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm rounded-full transition-colors whitespace-nowrap {{ $selectedCategory === null ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Semua
            </button>
            @foreach($categories as $category)
            <button wire:click="filterByCategory({{ $category->id }})" 
                    class="flex-shrink-0 px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm rounded-full transition-colors whitespace-nowrap {{ $selectedCategory === $category->id ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                {{ $category->nama }}
            </button>
            @endforeach
        </div>
    </div>

    @if($featuredNews)
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
        {{-- Featured News - Full width on mobile --}}
        <article class="group">
            <a href="{{ url('/berita/'.$featuredNews->slug) }}" class="block">
                <div class="aspect-[16/10] rounded-xl sm:rounded-2xl overflow-hidden mb-3 sm:mb-4">
                    @if($featuredNews->getFirstMediaUrl('thumbnail'))
                    <img src="{{ $featuredNews->getFirstMediaUrl('thumbnail') }}" 
                         alt="{{ $featuredNews->judul }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <svg class="w-12 h-12 sm:w-16 sm:h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @endif
                </div>
                
                <div class="flex flex-wrap items-center gap-2 sm:gap-3 mb-2 sm:mb-3">
                    <span class="px-2 sm:px-3 py-0.5 sm:py-1 text-xs font-medium rounded-full" style="background-color: {{ $featuredNews->kategori->warna ?? '#1B3B6F' }}20; color: {{ $featuredNews->kategori->warna ?? '#1B3B6F' }}">
                        {{ $featuredNews->kategori->nama ?? 'Umum' }}
                    </span>
                    <span class="text-gray-500 text-xs sm:text-sm">
                        {{ $featuredNews->published_at->format('d M Y') }}
                    </span>
                </div>
                
                <h3 class="font-heading text-lg sm:text-xl md:text-2xl font-bold text-gray-900 mb-2 sm:mb-3 group-hover:text-accent transition-colors line-clamp-2 sm:line-clamp-3">
                    {{ $featuredNews->judul }}
                </h3>
                
                <p class="text-gray-600 text-sm sm:text-base line-clamp-2 sm:line-clamp-3">
                    {{ Str::limit(strip_tags($featuredNews->excerpt ?? $featuredNews->konten), 180) }}
                </p>
            </a>
        </article>

        {{-- Side News List --}}
        <div class="flex flex-col gap-3 sm:gap-4">
            @foreach($sideNews as $news)
            <article class="group flex gap-3 sm:gap-4">
                <a href="{{ url('/berita/'.$news->slug) }}" class="block flex-shrink-0">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 lg:w-24 lg:h-24 xl:w-28 xl:h-28 rounded-lg sm:rounded-xl overflow-hidden">
                        @if($news->getFirstMediaUrl('thumbnail'))
                        <img src="{{ $news->getFirstMediaUrl('thumbnail') }}" 
                             alt="{{ $news->judul }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @endif
                    </div>
                </a>
                
                <div class="flex-1 min-w-0 py-0.5">
                    <div class="flex flex-wrap items-center gap-1.5 sm:gap-2 mb-1 sm:mb-2">
                        <span class="px-1.5 sm:px-2 py-0.5 text-[10px] sm:text-xs font-medium rounded" style="background-color: {{ $news->kategori->warna ?? '#1B3B6F' }}20; color: {{ $news->kategori->warna ?? '#1B3B6F' }}">
                            {{ $news->kategori->nama ?? 'Umum' }}
                        </span>
                        <span class="text-gray-400 text-[10px] sm:text-xs">
                            {{ $news->published_at->format('d M') }}
                        </span>
                    </div>
                    
                    <a href="{{ url('/berita/'.$news->slug) }}">
                        <h4 class="font-heading font-semibold text-sm sm:text-base text-gray-900 group-hover:text-accent transition-colors line-clamp-2 sm:line-clamp-3 leading-tight sm:leading-snug">
                            {{ $news->judul }}
                        </h4>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
    @else
    <div class="text-center py-8 sm:py-12">
        <p class="text-gray-500 text-sm sm:text-base">Belum ada berita tersedia.</p>
    </div>
    @endif

    <div class="mt-6 sm:mt-8 text-center">
        <a href="{{ url('/berita') }}" class="inline-flex items-center px-4 sm:px-6 py-2.5 sm:py-3 border-2 border-primary text-primary font-semibold rounded-lg hover:bg-primary hover:text-white transition-colors text-sm sm:text-base">
            Lihat Semua Berita
            <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-1.5 sm:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
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