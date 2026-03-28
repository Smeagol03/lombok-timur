<?php

use App\Models\SliderHero;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    #[Computed]
    public function slides()
    {
        return SliderHero::active()
            ->with('media')
            ->ordered()
            ->get();
    }
};
?>

@if($this->slides->count() > 0)
<div class="relative w-full overflow-hidden !bg-white" 
     x-data="{ swiper: null }"
     x-init="
        if (typeof Swiper !== 'undefined' && window.SwiperModules) {
            Swiper.use([window.SwiperModules.Navigation, window.SwiperModules.Pagination, window.SwiperModules.Autoplay, window.SwiperModules.EffectFade]);
        }
        swiper = new Swiper($el.querySelector('.hero-slider'), {
            loop: true,
            speed: 1200,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            pagination: {
                el: $el.querySelector('.swiper-pagination-custom'),
                type: 'fraction',
                formatFractionCurrent: function (number) {
                    return ('0' + number).slice(-2);
                },
                formatFractionTotal: function (number) {
                    return ('0' + number).slice(-2);
                },
                renderFraction: function (currentClass, totalClass) {
                    return '<span class=&quot;' + currentClass + '&quot;></span>' +
                           '<span class=&quot;mx-3 opacity-20&quot;>|</span>' +
                           '<span class=&quot;' + totalClass + '&quot;></span>';
                }
            },
            navigation: {
                nextEl: Array.from($el.querySelectorAll('.swiper-button-next-custom')),
                prevEl: Array.from($el.querySelectorAll('.swiper-button-prev-custom')),
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
        });
     ">
    <div class="swiper hero-slider h-auto lg:h-[600px] xl:h-[700px] !bg-white">
        <div class="swiper-wrapper">
            @foreach($this->slides as $slide)
            <div class="swiper-slide h-full !bg-white">
                <div class="grid grid-cols-1 lg:grid-cols-12 h-full">
                    {{-- Text Section --}}
                    <div class="lg:col-span-5 flex flex-col justify-center p-8 sm:p-12 lg:p-16 xl:p-20 !bg-white order-2 lg:order-1 relative z-20">
                        <div class="space-y-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-[3px] bg-accent"></div>
                                <span class="text-xs font-black tracking-[0.2em] uppercase !text-primary">Update Terbaru</span>
                            </div>
                            
                            <h2 class="text-3xl sm:text-4xl md:text-5xl xl:text-6xl font-heading font-extrabold !text-primary leading-[1.1] tracking-tighter">
                                {{ $slide->judul }}
                            </h2>
                            
                            @if($slide->subtitle)
                            <p class="text-base sm:text-lg !text-gray-900 leading-relaxed max-w-xl font-body font-medium">
                                {{ $slide->subtitle }}
                            </p>
                            @endif
                            
                            @if($slide->url_link)
                            <div class="pt-4 lg:pt-8">
                                <a href="{{ $slide->url_link }}"
                                   class="inline-flex items-center gap-3 px-8 py-4 bg-accent text-white font-bold transition-all duration-300 hover:bg-accent-dark group shadow-xl hover:shadow-2xl relative overflow-hidden">
                                    <span class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                                    <span class="uppercase tracking-widest text-sm relative z-10 drop-shadow-md">{{ $slide->label_tombol ?: 'Selengkapnya' }}</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform flex-shrink-0 relative z-10 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Image Section --}}
                    <div class="lg:col-span-7 relative min-h-[350px] sm:min-h-[450px] lg:h-full order-1 lg:order-2 overflow-hidden bg-gray-100">
                        @if($slide->getFirstMediaUrl('gambar'))
                        <img src="{{ $slide->getFirstMediaUrl('gambar') }}"
                             alt="{{ $slide->judul }}"
                             class="w-full h-full object-cover grayscale-[10%] hover:grayscale-0 transition-all duration-1000">
                        @else
                        <img src="https://picsum.photos/1200/800?random={{ $slide->id }}"
                             alt="{{ $slide->judul }}"
                             class="w-full h-full object-cover grayscale-[10%]">
                        @endif
                        
                        {{-- Subtle Overlay for Image Section only --}}
                        <div class="absolute inset-0 bg-primary/5 pointer-events-none"></div>
                        
                        {{-- Subtle Geometric Element --}}
                        <div class="absolute top-0 left-0 w-20 h-20 !bg-white hidden lg:block z-30"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        {{-- Navigation & Pagination - Desktop Only (inside slider) --}}
        <div class="hidden lg:flex absolute bottom-0 left-0 z-40 items-end pointer-events-none">
            <div class="flex items-center !bg-white border-t border-r border-gray-200 p-3 sm:p-5 pointer-events-auto">
                <button type="button" class="swiper-button-prev-custom p-3 !text-primary hover:text-accent transition-colors focus:outline-none cursor-pointer pointer-events-auto" style="cursor: pointer !important;">
                    <svg class="w-7 h-7 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <div class="swiper-pagination-custom text-base font-black font-heading px-8 !text-primary tracking-[0.2em] min-w-[100px] text-center pointer-events-none"></div>
                <button type="button" class="swiper-button-next-custom p-3 !text-primary hover:text-accent transition-colors focus:outline-none cursor-pointer pointer-events-auto" style="cursor: pointer !important;">
                    <svg class="w-7 h-7 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    {{-- Navigation & Pagination - Mobile Only (below slider) --}}
    <div class="lg:hidden flex justify-center items-center !bg-white border-t border-gray-200 p-4 pointer-events-auto mt-0">
        <button type="button" class="swiper-button-prev-custom p-3 !text-primary hover:text-accent transition-colors focus:outline-none cursor-pointer pointer-events-auto" style="cursor: pointer !important;">
            <svg class="w-6 h-6 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <div class="swiper-pagination-custom text-base font-black font-heading px-6 !text-primary tracking-[0.2em] min-w-[80px] text-center pointer-events-none"></div>
        <button type="button" class="swiper-button-next-custom p-3 !text-primary hover:text-accent transition-colors focus:outline-none cursor-pointer pointer-events-auto" style="cursor: pointer !important;">
            <svg class="w-6 h-6 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>
</div>

@else
{{-- Default Hero when no slides - Swiss Layout --}}
<div class="relative w-full !bg-white overflow-hidden border-b border-gray-100">
    <div class="grid grid-cols-1 lg:grid-cols-12 h-auto lg:min-h-[600px]">
        <div class="lg:col-span-6 flex flex-col justify-center p-8 sm:p-12 lg:p-20 xl:p-24 order-2 lg:order-1 !bg-white relative z-10">
            <div class="space-y-6 lg:space-y-8">
                <div class="inline-flex items-center gap-3">
                    <div class="w-8 h-[3px] !bg-primary"></div>
                    <span class="!text-primary text-[11px] font-black tracking-[0.4em] uppercase">Official Portal</span>
                </div>
                <h1 class="text-5xl sm:text-6xl md:text-7xl xl:text-8xl font-heading font-extrabold !text-primary leading-[0.95] tracking-tighter">
                    LOMBOK <br><span class="text-accent">TIMUR.</span>
                </h1>
                <p class="text-xl sm:text-2xl !text-gray-900 max-w-xl font-body leading-relaxed font-medium">
                    Melayani dengan transparansi dan profesionalisme untuk masyarakat.
                </p>
                <div class="pt-6 lg:pt-10">
                    <a href="{{ url('/layanan') }}" class="inline-flex items-center gap-5 px-10 py-5 bg-accent text-white font-black transition-all duration-300 hover:bg-accent-dark group shadow-xl shadow-accent/30 relative overflow-hidden">
                        <span class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span class="uppercase tracking-widest text-sm relative z-10 drop-shadow-md">E-Layanan Publik</span>
                        <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform relative z-10 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="lg:col-span-6 relative h-[400px] sm:h-[500px] lg:h-auto order-1 lg:order-2 bg-gray-50 overflow-hidden">
            <div class="absolute inset-0 bg-primary/10 mix-blend-multiply z-10"></div>
            <img src="https://picsum.photos/1200/1200?grayscale" alt="Lombok Timur" class="w-full h-full object-cover">
            
            {{-- Decorative Grid Overlay --}}
            <div class="absolute inset-0 z-20 opacity-[0.05]" style="background-image: radial-gradient(circle, #000 1.5px, transparent 1.5px); background-size: 40px 40px;"></div>
        </div>
    </div>
</div>
@endif