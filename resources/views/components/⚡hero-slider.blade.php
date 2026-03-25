<?php

use App\Models\SliderHero;
use Livewire\Component;

new class extends Component
{
    public $slides;

    public function mount(): void
    {
        $this->slides = SliderHero::active()
            ->ordered()
            ->get();
    }
};
?>

@if($slides->count() > 0)
<div class="relative w-full h-[400px] md:h-[500px] lg:h-[600px]" wire:ignore>
    <div class="swiper hero-slider h-full">
        <div class="swiper-wrapper">
            @foreach($slides as $slide)
            <div class="swiper-slide relative">
                @if($slide->getFirstMediaUrl('gambar'))
                <img src="{{ $slide->getFirstMediaUrl('gambar') }}" 
                     alt="{{ $slide->judul }}" 
                     class="w-full h-full object-cover">
                @else
                <div class="w-full h-full bg-gradient-to-r from-primary to-primary-dark flex items-center justify-center">
                    <span class="text-white/20 text-6xl font-heading font-bold">{{ $slide->judul }}</span>
                </div>
                @endif
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                
                <div class="absolute bottom-0 left-0 right-0 p-6 md:p-12 lg:p-16">
                    <div class="max-w-7xl mx-auto">
                        <h2 class="text-2xl md:text-4xl lg:text-5xl font-heading font-bold text-white mb-3">
                            {{ $slide->judul }}
                        </h2>
                        @if($slide->subtitle)
                        <p class="text-lg md:text-xl text-gray-200 mb-6 max-w-2xl">
                            {{ $slide->subtitle }}
                        </p>
                        @endif
                        @if($slide->url_link)
                        <a href="{{ $slide->url_link }}" 
                           class="inline-flex items-center px-6 py-3 bg-accent hover:bg-accent-dark text-white font-semibold rounded-button transition-colors">
                            {{ $slide->label_tombol ?: 'Selengkapnya' }}
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="swiper-pagination"></div>
        
        <button class="swiper-button-prev !w-12 !h-12 !bg-white/20 hover:!bg-white/40 !rounded-full !text-white !backdrop-blur-sm !transition-all !left-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button class="swiper-button-next !w-12 !h-12 !bg-white/20 hover:!bg-white/40 !rounded-full !text-white !backdrop-blur-sm !transition-all !right-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>
</div>

@script
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.hero-slider', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                bulletActiveClass: '!bg-accent',
                bulletClass: 'swiper-pagination-bullet !bg-white/50 !w-3 !h-3 !mx-1',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
        });
    });
</script>
@endscript
@else
{{-- Default Hero when no slides --}}
<div class="relative w-full h-[400px] md:h-[500px] lg:h-[600px] bg-gradient-to-r from-primary to-primary-dark">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center px-4">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold text-white mb-4">
                Portal <span class="text-accent">Lombok Timur</span>
            </h1>
            <p class="text-xl text-gray-200 max-w-2xl mx-auto mb-8">
                Pemerintah Kabupaten Lombok Timur melayani masyarakat dengan transparan dan profesional.
            </p>
            <a href="{{ url('/layanan') }}" class="inline-flex items-center px-8 py-4 bg-accent hover:bg-accent-dark text-white font-bold rounded-button transition-colors">
                Jelajahi Layanan
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</div>
@endif
