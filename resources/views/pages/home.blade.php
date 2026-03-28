<x-layouts.app
    :title="$title ?? null"
    :description="$description ?? null"
    :keywords="$keywords ?? null"
    :ogImage="$ogImage ?? null">
    <div class="bg-gray-50">
        {{-- Hero Slider --}}
        <section>
            <livewire:hero-slider />
        </section>

        {{-- Quick Access / Layanan - Swiss Design Grid --}}
        <section class="py-16 md:py-24 bg-white">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                {{-- Section Header - Asymmetrical Balance --}}
                <div class="mb-16">
                    <div class="flex items-baseline gap-4 mb-3">
                        <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">01</span>
                        <h2 class="font-sans text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 tracking-tight">Layanan Publik</h2>
                    </div>
                    <div class="max-w-2xl">
                        <p class="text-base text-gray-600 leading-relaxed">Akses layanan pemerintah Kabupaten Lombok Timur dengan mudah</p>
                    </div>
                </div>

{{-- Services Grid - Strict Modular Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-px bg-gray-200 border border-gray-200">
                    @foreach($featuredServices as $index => $layanan)
                    <a href="{{ $layanan->url_eksternal ?: url('/layanan/'.$layanan->slug) }}"
                       class="group relative bg-white p-8 hover:bg-gray-50 transition-colors">
                        {{-- Index Number - Typography as Visual Element --}}
                        <span class="absolute top-6 right-6 text-xs font-mono text-gray-300 group-hover:text-gray-400 transition-colors">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        {{-- Icon/Image - Minimalist Presentation --}}
                        <div class="w-12 h-12 mb-6 flex items-center justify-center">
                            @if($layanan->icon_type === 'image' && $layanan->getFirstMediaUrl('icon'))
                                <img src="{{ $layanan->getFirstMediaUrl('icon') }}" 
                                     alt="{{ $layanan->nama }}"
                                     class="w-10 h-auto object-contain">
                            @elseif($layanan->icon_type === 'icon' && $layanan->icon)
                                @svg($layanan->icon, 'w-6 h-6 text-gray-900 group-hover:text-primary transition-colors')
                            @endif
                        </div>

                        {{-- Title - Clear Hierarchy --}}
                        <h3 class="font-sans text-base font-medium text-gray-900 group-hover:text-primary transition-colors leading-snug">
                            {{ $layanan->nama }}
                        </h3>

                        {{-- Arrow Indicator - Functional Detail --}}
                        <div class="mt-6 flex items-center gap-3 text-xs font-medium text-gray-400 group-hover:text-primary transition-colors">
                            <span>Akses</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                    @endforeach
                </div>

                {{-- View All - Clean Navigation --}}
                <div class="mt-12">
                    <a href="{{ url('/layanan') }}" class="group inline-flex items-center gap-3 text-sm font-medium text-gray-900 hover:text-primary transition-colors">
                        <span>Lihat Semua Layanan</span>
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        {{-- Berita Terbaru --}}
        <section class="py-10 md:py-14 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <livewire:berita-terbaru />
            </div>
        </section>

        {{-- Agenda Kegiatan --}}
        <section class="py-10 md:py-14 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <livewire:agenda-kegiatan />
            </div>
        </section>

        {{-- Data Publik: Harga Pokok & Stok Darah --}}
        <section class="py-10 md:py-14 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <livewire:harga-pokok />
                    <livewire:stok-darah />
                </div>
            </div>
        </section>

        {{-- Wisata Gallery --}}
        <section class="py-10 md:py-14 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <livewire:wisata-gallery />
            </div>
        </section>

        {{-- CTA Section - Clean Accent --}}
        <section class="py-12 md:py-16 bg-accent">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="font-heading text-xl md:text-2xl lg:text-3xl font-bold text-white mb-3">Butuh Bantuan?</h2>
                <p class="text-sm md:text-base text-white/90 mb-6 max-w-xl mx-auto">
                    Hubungi call center kami untuk informasi lebih lanjut mengenai layanan pemerintah Kabupaten Lombok Timur.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    @if($setting?->contact_phone)
                    <a href="tel:{{ $setting->contact_phone }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-accent font-semibold rounded-md hover:bg-gray-100 transition-colors shadow-lg relative overflow-hidden group">
                        <span class="absolute inset-0 bg-accent/5 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <svg class="w-5 h-5 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="relative z-10">{{ $setting->contact_phone }}</span>
                    </a>
                    @else
                    <a href="tel:0376123456" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-accent font-semibold rounded-md hover:bg-gray-100 transition-colors shadow-lg relative overflow-hidden group">
                        <span class="absolute inset-0 bg-accent/5 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <svg class="w-5 h-5 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="relative z-10">(0376) 123456</span>
                    </a>
                    @endif
                    <a href="{{ url('/layanan') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-accent font-semibold rounded-md hover:bg-gray-100 transition-colors shadow-lg border-2 border-white relative overflow-hidden group">
                        <span class="absolute inset-0 bg-accent/5 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span class="relative z-10">Lihat Semua Layanan</span>
                    </a>
                </div>
            </div>
        </section>
    </div>
</x-layouts.app>
