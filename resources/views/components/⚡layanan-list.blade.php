<?php

use App\Models\Layanan;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public $search = '';

    #[Computed]
    public function layanans()
    {
        $query = Layanan::active()->with('media')->ordered();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama', 'like', '%'.$this->search.'%')
                    ->orWhere('deskripsi', 'like', '%'.$this->search.'%')
                    ->orWhere('dinas_terkait', 'like', '%'.$this->search.'%');
            });
        }

        return $query->get();
    }
};
?>

<div class="w-full">
    {{-- Search Section --}}
    <div class="bg-white rounded-card p-6 mb-8 shadow-sm">
        <div class="relative max-w-xl mx-auto">
            <input wire:model.live.debounce.300ms="search" 
                   type="text" 
                   placeholder="Cari layanan..." 
                   class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        
        @if($search)
        <div class="text-center mt-4">
            <span class="text-sm text-gray-500">
                Menampilkan {{ $this->layanans->count() }} hasil untuk "{{ $search }}"
            </span>
            <button wire:click="$set('search', '')" class="ml-2 text-primary hover:text-accent text-sm font-medium">
                Reset pencarian
            </button>
        </div>
        @endif
    </div>

    {{-- Services Grid --}}
    @if($this->layanans->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($this->layanans as $layanan)
        <article class="bg-white rounded-card shadow-sm overflow-hidden hover:shadow-md transition-shadow border border-gray-100">
            <a href="{{ url('/layanan/'.$layanan->slug) }}" class="block p-6 h-full">
                <div class="flex flex-col h-full">
                    {{-- Icon --}}
                    <div class="w-16 h-16 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                        @if($layanan->icon_type === 'image' && $layanan->getFirstMediaUrl('icon'))
                            <img src="{{ $layanan->getFirstMediaUrl('icon') }}" alt="{{ $layanan->nama }}" class="w-8 h-8 object-contain">
                        @elseif($layanan->icon_type === 'icon' && $layanan->icon)
                            @svg($layanan->icon, 'w-8 h-8 text-primary')
                        @else
                            @svg('heroicon-o-information-circle', 'w-8 h-8 text-primary')
                        @endif
                    </div>
                    
                    {{-- Content --}}
                    <h3 class="font-heading font-semibold text-lg text-gray-900 mb-2 hover:text-accent transition-colors">
                        {{ $layanan->nama }}
                    </h3>
                    
                    <p class="text-gray-600 text-sm flex-grow line-clamp-3">
                        {{ Str::limit(strip_tags($layanan->deskripsi), 120) }}
                    </p>
                    
                    @if($layanan->dinas_terkait)
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-sm text-gray-500">
                            <span class="font-medium">Dinas Terkait:</span> {{ $layanan->dinas_terkait }}
                        </p>
                    </div>
                    @endif
                    
                    <div class="mt-4 flex items-center text-primary font-medium text-sm">
                        Lihat detail
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
        </article>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 bg-gray-50 rounded-card">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada layanan</h3>
        <p class="text-gray-500">Tidak ditemukan layanan dengan pencarian tersebut.</p>
    </div>
    @endif
</div>