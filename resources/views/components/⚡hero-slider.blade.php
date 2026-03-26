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
<div class="relative w-full h-[300px] sm:h-[400px] md:h-[500px] lg:h-[550px] xl:h-[600px]" wire:ignore>
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
                    <span class="text-white/20 text-4xl sm:text-5xl md:text-6xl font-heading font-bold px-4 text-center">{{ $slide->judul }}</span>
                </div>
                @endif
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                
                <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6 md:p-10 lg:p-12">
                    <div class="max-w-7xl mx-auto">
                        <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl font-heading font-bold text-white mb-2 sm:mb-3 leading-tight">
                            {{ $slide->judul }}
                        </h2>
                        @if($slide->subtitle)
                        <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-200 mb-4 sm:mb-6 max-w-2xl line-clamp-2 sm:line-clamp-none">
                            {{ $slide->subtitle }}
                        </p>
                        @endif
                        @if($slide->url_link)
                        <a href="{{ $slide->url_link }}" 
                           class="inline-flex items-center px-4 sm:px-6 py-2.5 sm:py-3 bg-accent hover:bg-accent-dark text-white font-semibold rounded-lg transition-colors text-sm sm:text-base">
                            {{ $slide->label_tombol ?: 'Selengkapnya' }}
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-1.5 sm:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="swiper-pagination !bottom-3 sm:!bottom-4"></div>
        
        {{-- Navigation Arrows - Hidden on mobile, visible on tablet+ --}}
        <button class="swiper-button-prev hidden sm:flex !w-10 !h-10 lg:!w-12 lg:!h-12 !bg-white/20 hover:!bg-white/40 !rounded-full !text-white !backdrop-blur-sm !transition-all !left-2 lg:!left-4 after:!text-sm lg:after:!text-base">
        </button>
        <button class="swiper-button-next hidden sm:flex !w-10 !h-10 lg:!w-12 lg:!h-12 !bg-white/20 hover:!bg-white/40 !rounded-full !text-white !backdrop-blur-sm !transition-all !right-2 lg:!right-4 after:!text-sm lg:after:!text-base">
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
                bulletActiveClass: '!bg-accent !w-6 sm:!w-8',
                bulletClass: 'swiper-pagination-bullet !bg-white/50 !w-2 sm:!w-3 !h-2 sm:!h-3 !mx-1 sm:!mx-1.5 !transition-all',
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
<div class="relative w-full h-[300px] sm:h-[400px] md:h-[500px] lg:h-[550px] bg-gradient-to-br from-primary via-primary-dark to-primary">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center px-4 sm:px-6 max-w-3xl mx-auto">
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-heading font-bold text-white mb-3 sm:mb-4 leading-tight">
                Portal <span class="text-accent">Lombok Timur</span>
            </h1>
            <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-200 max-w-2xl mx-auto mb-6 sm:mb-8 px-2 sm:px-0">
                Pemerintah Kabupaten Lombok Timur melayani masyarakat dengan transparan dan profesional.
            </p>
            <a href="{{ url('/layanan') }}" class="inline-flex items-center px-5 sm:px-8 py-2.5 sm:py-4 bg-accent hover:bg-accent-dark text-white font-bold rounded-lg transition-colors text-sm sm:text-base shadow-lg shadow-accent/30">
                Jelajahi Layanan
                <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</div>
@endif