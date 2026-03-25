<?php

use App\Models\Agenda;
use Livewire\Component;

new class extends Component
{
    public $activeTab = 'bupati';

    public $agendas = [];

    public $selectedDate = null;

    public function mount(): void
    {
        $this->loadAgendas();
    }

    public function loadAgendas(): void
    {
        $query = Agenda::upcoming();

        if ($this->selectedDate) {
            $query->whereDate('tanggal', $this->selectedDate);
        }

        $this->agendas = $query->get()->groupBy('jenis');
    }

    public function setTab($tab): void
    {
        $this->activeTab = $tab;
    }

    public function filterByDate($date): void
    {
        $this->selectedDate = $date;
        $this->loadAgendas();
    }

    public function clearDateFilter(): void
    {
        $this->selectedDate = null;
        $this->loadAgendas();
    }
};
?>

<div class="w-full">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
        <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary">
            Agenda Kegiatan
        </h2>
        
        @if($selectedDate)
        <div class="flex items-center gap-2">
            <span class="text-sm text-gray-600">
                Filter: {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}
            </span>
            <button wire:click="clearDateFilter" class="text-red-500 hover:text-red-700 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        @endif
    </div>

    {{-- Tabs --}}
    <div class="flex border-b border-gray-200 mb-6">
        <button wire:click="setTab('bupati')" 
                class="px-6 py-3 text-sm font-medium border-b-2 transition-colors {{ $activeTab === 'bupati' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Bupati
            </span>
        </button>
        <button wire:click="setTab('wabup')" 
                class="px-6 py-3 text-sm font-medium border-b-2 transition-colors {{ $activeTab === 'wabup' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Wakil Bupati
            </span>
        </button>
        <button wire:click="setTab('sekda')" 
                class="px-6 py-3 text-sm font-medium border-b-2 transition-colors {{ $activeTab === 'sekda' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Sekda
            </span>
        </button>
    </div>

    {{-- Content --}}
    <div class="space-y-4">
        @php
        $currentAgendas = $agendas[$activeTab] ?? collect();
        @endphp

        @if($currentAgendas->count() > 0)
            @foreach($currentAgendas as $agenda)
            <div class="bg-white rounded-card p-4 md:p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    {{-- Date Badge --}}
                    <div class="flex-shrink-0 w-16 h-16 bg-primary/10 rounded-lg flex flex-col items-center justify-center text-primary">
                        <span class="text-xs font-medium uppercase">{{ $agenda->tanggal->format('M') }}</span>
                        <span class="text-2xl font-bold">{{ $agenda->tanggal->format('d') }}</span>
                    </div>
                    
                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <h3 class="font-heading font-semibold text-lg text-gray-900 mb-1">
                            {{ $agenda->judul }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-2 line-clamp-2">
                            {{ $agenda->deskripsi }}
                        </p>
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $agenda->jam_mulai->format('H:i') }}{{ $agenda->jam_selesai ? ' - '.$agenda->jam_selesai->format('H:i') : '' }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $agenda->lokasi }}
                            </span>
                        </div>
                    </div>

                    {{-- Action --}}
                    <button wire:click="filterByDate('{{ $agenda->tanggal->format('Y-m-d') }}')" 
                            class="text-primary hover:text-accent text-sm font-medium whitespace-nowrap">
                        Lihat Detail
                    </button>
                </div>
            </div>
            @endforeach
        @else
            <div class="text-center py-12 bg-gray-50 rounded-card">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-gray-500">Tidak ada agenda kegiatan untuk {{ ucfirst($activeTab) }}.</p>
            </div>
        @endif
    </div>

    <div class="mt-6 text-center">
        <a href="{{ url('/agenda') }}" class="inline-flex items-center text-primary hover:text-accent font-medium transition-colors">
            Lihat Semua Agenda
            <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</div>
