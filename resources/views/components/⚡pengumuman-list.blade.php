<?php

use App\Models\Pengumuman;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public $search = '';

    public $showImportantOnly = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'showImportantOnly' => ['except' => false],
    ];

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedShowImportantOnly(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function pengumumen()
    {
        $query = Pengumuman::active()
            ->orderBy('is_penting', 'desc')
            ->latest('tanggal_terbit');

        if ($this->showImportantOnly) {
            $query->penting();
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('judul', 'like', '%'.$this->search.'%')
                    ->orWhere('konten', 'like', '%'.$this->search.'%');
            });
        }

        return $query->paginate(10);
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
                           placeholder="Cari pengumuman..." 
                           class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
            
            {{-- Important Filter --}}
            <div class="flex items-center">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input wire:model.live="showImportantOnly" 
                           type="checkbox" 
                           class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary">
                    <span class="text-gray-700">Hanya pengumuman penting</span>
                </label>
            </div>
        </div>
        
        {{-- Active Filters --}}
        @if($search || $showImportantOnly)
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
            @if($showImportantOnly)
            <span class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 text-sm rounded-full">
                Penting saja
                <button wire:click="$set('showImportantOnly', false)" class="ml-2 hover:text-red-900">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </span>
            @endif
            <button wire:click="$set('search', ''); $set('showImportantOnly', false)" 
                    class="text-sm text-gray-500 hover:text-red-500">
                Reset semua
            </button>
        </div>
        @endif
    </div>

    {{-- Results Count --}}
    <div class="mb-6">
        <p class="text-gray-600">
            Menampilkan {{ $this->pengumumen->firstItem() ?? 0 }} - {{ $this->pengumumen->lastItem() ?? 0 }} dari {{ $this->pengumumen->total() }} pengumuman
        </p>
    </div>

    {{-- Announcements List --}}
    @if($this->pengumumen->count() > 0)
    <div class="space-y-6">
        @foreach($this->pengumumen as $pengumuman)
        <article class="bg-white rounded-card shadow-sm overflow-hidden hover:shadow-md transition-shadow border border-gray-100 {{ $pengumuman->is_penting ? 'border-l-4 border-l-red-500' : '' }}">
            <a href="{{ url('/pengumuman/'.$pengumuman->slug) }}" class="block p-6">
                <div class="flex flex-col md:flex-row md:items-start gap-4">
                    {{-- Icon/Date --}}
                    <div class="flex-shrink-0 w-16 h-16 bg-primary/10 rounded-lg flex flex-col items-center justify-center">
                        <span class="text-2xl font-bold text-primary">{{ $pengumuman->tanggal_terbit->format('d') }}</span>
                        <span class="text-xs text-primary/70 uppercase">{{ $pengumuman->tanggal_terbit->format('M') }}</span>
                    </div>
                    
                    {{-- Content --}}
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            @if($pengumuman->is_penting)
                            <span class="px-2 py-0.5 text-xs font-medium bg-red-100 text-red-700 rounded-full">
                                Penting
                            </span>
                            @endif
                            @if($pengumuman->tanggal_kadaluarsa && $pengumuman->tanggal_kadaluarsa->isFuture())
                            <span class="px-2 py-0.5 text-xs font-medium bg-yellow-100 text-yellow-700 rounded-full">
                                Berlaku hingga {{ $pengumuman->tanggal_kadaluarsa->format('d M Y') }}
                            </span>
                            @endif
                        </div>
                        
                        <h3 class="font-heading font-semibold text-lg text-gray-900 hover:text-accent transition-colors mb-2">
                            {{ $pengumuman->judul }}
                        </h3>
                        
                        <p class="text-gray-600 text-sm line-clamp-2">
                            {{ Str::limit(strip_tags($pengumuman->konten), 150) }}
                        </p>
                        
                        @if($pengumuman->getMedia('lampiran')->count() > 0)
                        <div class="flex items-center gap-2 mt-3 text-sm text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                            </svg>
                            <span>{{ $pengumuman->getMedia('lampiran')->count() }} lampiran</span>
                        </div>
                        @endif
                    </div>
                    
                    {{-- Arrow --}}
                    <div class="flex-shrink-0 hidden md:block">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
        </article>
        @endforeach
    </div>
    
    {{-- Pagination --}}
    <div class="mt-8">
        {{ $this->pengumumen->links() }}
    </div>
    @else
    <div class="text-center py-16 bg-gray-50 rounded-card">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada pengumuman</h3>
        <p class="text-gray-500">Tidak ditemukan pengumuman dengan filter yang dipilih.</p>
    </div>
    @endif
</div>