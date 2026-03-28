<?php

use App\Models\Berita;
use App\Models\Kategori;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public $selectedCategory = null;

    #[Computed]
    public function categories()
    {
        return Kategori::all();
    }

    #[Computed]
    public function featuredNews()
    {
        return $this->getNewsQuery()->first();
    }

    #[Computed]
    public function sideNews()
    {
        return $this->getNewsQuery()->skip(1)->take(5);
    }

    protected function getNewsQuery()
    {
        $query = Berita::published()->with('kategori');

        if ($this->selectedCategory) {
            $query->where('kategori_id', $this->selectedCategory);
        }

        return $query->latest('published_at')->take(6)->get();
    }

    public function filterByCategory($categoryId): void
    {
        $this->selectedCategory = $categoryId;
    }
};
?>

<div>
    {{-- Section Header with Filter --}}
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
            <div>
                <h2 class="font-heading text-xl md:text-2xl font-bold text-primary">Berita Terbaru</h2>
                <p class="text-sm text-gray-500 mt-0.5">Informasi terkini dari Kabupaten Lombok Timur</p>
            </div>
            <a href="{{ url('/berita') }}" class="text-sm font-medium text-primary hover:text-primary-dark flex items-center gap-1">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        
        {{-- Category Pills --}}
        <div class="flex gap-2 overflow-x-auto pb-2 -mx-4 px-4 sm:mx-0 sm:px-0 scrollbar-hide">
            <button wire:click="filterByCategory(null)" 
                    class="flex-shrink-0 px-3 py-1.5 text-xs font-medium rounded-md transition-colors whitespace-nowrap {{ $selectedCategory === null ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Semua
            </button>
            @foreach($this->categories as $category)
            <button wire:click="filterByCategory({{ $category->id }})" 
                    class="flex-shrink-0 px-3 py-1.5 text-xs font-medium rounded-md transition-colors whitespace-nowrap {{ $selectedCategory === $category->id ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                {{ $category->nama }}
            </button>
            @endforeach
        </div>
    </div>

    @if($this->featuredNews)
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
        {{-- Featured News --}}
        <article class="lg:col-span-3 group">
            <a href="{{ url('/berita/'.$this->featuredNews->slug) }}" class="block">
                <div class="aspect-[16/10] rounded-lg overflow-hidden mb-4 bg-gray-100">
                    @if($this->featuredNews->getFirstMediaUrl('thumbnail'))
                    <img src="{{ $this->featuredNews->getFirstMediaUrl('thumbnail') }}" 
                         alt="{{ $this->featuredNews->judul }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <img src="https://picsum.photos/800/500?random={{ $this->featuredNews->id }}" 
                         alt="{{ $this->featuredNews->judul }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @endif
                </div>
                
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-2 py-0.5 text-xs font-medium rounded" style="background-color: {{ $this->featuredNews->kategori->warna ?? '#1B3B6F' }}20; color: {{ $this->featuredNews->kategori->warna ?? '#1B3B6F' }}">
                        {{ $this->featuredNews->kategori->nama ?? 'Umum' }}
                    </span>
                    <span class="text-gray-400 text-xs">
                        {{ $this->featuredNews->published_at->format('d M Y') }}
                    </span>
                </div>
                
                <h3 class="font-heading text-lg md:text-xl font-bold text-gray-900 mb-2 group-hover:text-primary transition-colors line-clamp-2">
                    {{ $this->featuredNews->judul }}
                </h3>
                
                <p class="text-sm text-gray-600 line-clamp-2">
                    {{ Str::limit(strip_tags($this->featuredNews->excerpt ?? $this->featuredNews->konten), 150) }}
                </p>
            </a>
        </article>

        {{-- Side News List --}}
        <div class="lg:col-span-2 flex flex-col divide-y divide-gray-100">
            @foreach($this->sideNews as $news)
            <article class="py-4 first:pt-0 last:pb-0 group">
                <a href="{{ url('/berita/'.$news->slug) }}" class="flex gap-3">
                    <div class="w-20 h-20 rounded-md overflow-hidden bg-gray-100 flex-shrink-0">
                        @if($news->getFirstMediaUrl('thumbnail'))
                        <img src="{{ $news->getFirstMediaUrl('thumbnail') }}" 
                             alt="{{ $news->judul }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                        <img src="https://picsum.photos/100/100?random={{ $news->id }}" 
                             alt="{{ $news->judul }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="px-1.5 py-0.5 text-[10px] font-medium rounded" style="background-color: {{ $news->kategori->warna ?? '#1B3B6F' }}20; color: {{ $news->kategori->warna ?? '#1B3B6F' }}">
                                {{ $news->kategori->nama ?? 'Umum' }}
                            </span>
                            <span class="text-gray-400 text-[10px]">
                                {{ $news->published_at->format('d M') }}
                            </span>
                        </div>
                        <h4 class="font-heading font-semibold text-sm text-gray-900 group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                            {{ $news->judul }}
                        </h4>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
    </div>
    @else
    <div class="text-center py-12 bg-gray-50 rounded-lg">
        <p class="text-gray-500 text-sm">Belum ada berita tersedia.</p>
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