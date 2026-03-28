<?php

use App\Models\Agenda;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public $activeTab = 'bupati';

    public $selectedDate = null;

    #[Computed]
    public function agendas()
    {
        $query = Agenda::upcoming();

        if ($this->selectedDate) {
            $query->whereDate('tanggal', $this->selectedDate);
        }

        return $query->get()->groupBy('jenis');
    }

    public function setTab($tab): void
    {
        $this->activeTab = $tab;
    }

    public function filterByDate($date): void
    {
        $this->selectedDate = $date;
    }

    public function clearDateFilter(): void
    {
        $this->selectedDate = null;
    }
};
?>

<div>
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="font-heading text-xl md:text-2xl font-bold text-primary">Agenda Kegiatan</h2>
            <p class="text-sm text-gray-500 mt-0.5">Jadwal kegiatan pejabat daerah</p>
        </div>
        
        @if($selectedDate)
        <div class="flex items-center gap-2 bg-gray-100 px-3 py-1.5 rounded-md self-start">
            <span class="text-xs text-gray-600">{{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}</span>
            <button wire:click="clearDateFilter" class="text-gray-400 hover:text-gray-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        @endif
    </div>

    {{-- Tabs --}}
    <div class="flex border-b border-gray-200 mb-6 overflow-x-auto -mx-4 px-4 sm:mx-0 sm:px-0 scrollbar-hide">
        <button wire:click="setTab('bupati')" 
                class="flex-shrink-0 px-4 py-3 text-sm font-medium border-b-2 transition-colors whitespace-nowrap {{ $activeTab === 'bupati' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
            Kepala Daerah
        </button>
        <button wire:click="setTab('wabup')" 
                class="flex-shrink-0 px-4 py-3 text-sm font-medium border-b-2 transition-colors whitespace-nowrap {{ $activeTab === 'wabup' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
            Wakil Kepala Daerah
        </button>
        <button wire:click="setTab('sekda')" 
                class="flex-shrink-0 px-4 py-3 text-sm font-medium border-b-2 transition-colors whitespace-nowrap {{ $activeTab === 'sekda' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
            Sekretaris Daerah
        </button>
    </div>

    {{-- Content --}}
    <div class="space-y-3">
        @php
        $currentAgendas = $this->agendas[$activeTab] ?? collect();
        @endphp

        @if($currentAgendas->count() > 0)
            @foreach($currentAgendas as $agenda)
            <div class="bg-white border border-gray-200 rounded-lg p-4 hover:border-primary/30 transition-colors">
                <div class="flex gap-4">
                    {{-- Date Badge --}}
                    <div class="flex-shrink-0 w-14 h-14 bg-primary text-white rounded-lg flex flex-col items-center justify-center">
                        <span class="text-[10px] font-medium uppercase">{{ $agenda->tanggal->format('M') }}</span>
                        <span class="text-xl font-bold leading-none">{{ $agenda->tanggal->format('d') }}</span>
                    </div>
                    
                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <h3 class="font-heading font-semibold text-base text-gray-900 mb-1 line-clamp-1">
                            {{ $agenda->judul }}
                        </h3>
                        <p class="text-sm text-gray-500 mb-2 line-clamp-1">
                            {{ $agenda->deskripsi }}
                        </p>
                        <div class="flex flex-wrap gap-4 text-xs text-gray-400">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $agenda->jam_mulai->format('H:i') }}{{ $agenda->jam_selesai ? ' - '.$agenda->jam_selesai->format('H:i') : '' }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $agenda->lokasi }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="text-center py-12 bg-gray-50 rounded-lg">
                <svg class="w-10 h-10 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-gray-500 text-sm">Tidak ada agenda kegiatan untuk pejabat ini.</p>
            </div>
        @endif
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