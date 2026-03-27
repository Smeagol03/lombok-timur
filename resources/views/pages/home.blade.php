<x-layouts.app>
    <div class="min-h-screen bg-background">
        {{-- Hero Slider --}}
        <section>
            <livewire:hero-slider />
        </section>
        
        {{-- Quick Access / Layanan --}}
        <section class="py-10 sm:py-12 md:py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8 sm:mb-10 md:mb-12">
                    <h2 class="font-heading text-xl sm:text-2xl md:text-3xl font-bold text-primary mb-2 sm:mb-3">
                        Layanan Publik
                    </h2>
                    <p class="text-gray-600 text-sm sm:text-base max-w-2xl mx-auto px-4 sm:px-0">
                        Akses berbagai layanan pemerintah Kabupaten Lombok Timur dengan mudah dan cepat.
                    </p>
                </div>
                
                {{-- Services Grid - 2 cols mobile, 3 tablet, 5 desktop --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4 md:gap-6">
                    @foreach($featuredServices as $layanan)
                    <a href="{{ $layanan->url_eksternal ?: url('/layanan/'.$layanan->slug) }}" 
                       class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-5 md:p-6 shadow-sm hover:shadow-lg transition-all text-center group border border-gray-100 hover:border-accent/30">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 bg-primary/10 rounded-lg sm:rounded-xl flex items-center justify-center mx-auto mb-2 sm:mb-3 md:mb-4 group-hover:bg-accent/20 transition-colors">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 text-primary group-hover:text-accent transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="font-heading font-semibold text-gray-900 mb-1 sm:mb-2 group-hover:text-accent transition-colors text-xs sm:text-sm md:text-base line-clamp-2">{{ $layanan->nama }}</h3>
                        <p class="text-gray-500 text-xs sm:text-sm line-clamp-2 hidden sm:block">{{ Str::limit($layanan->deskripsi, 50) }}</p>
                    </a>
                    @endforeach
                </div>
                
                <div class="mt-6 sm:mt-8 md:mt-10 text-center">
                    <a href="{{ url('/layanan') }}" class="inline-flex items-center px-4 sm:px-6 py-2.5 sm:py-3 border-2 border-primary text-primary font-semibold rounded-lg hover:bg-primary hover:text-white transition-colors text-sm sm:text-base">
                        Semua Layanan
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-1.5 sm:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
        
        {{-- Berita Terbaru --}}
        <section class="py-10 sm:py-12 md:py-16 bg-background">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <livewire:berita-terbaru />
            </div>
        </section>
        
        {{-- Agenda Kegiatan --}}
        <section class="py-10 sm:py-12 md:py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <livewire:agenda-kegiatan />
            </div>
        </section>
        
        {{-- Data Publik: Harga Pokok & Stok Darah --}}
        <section class="py-10 sm:py-12 md:py-16 bg-background">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
                    <livewire:harga-pokok />
                    <livewire:stok-darah />
                </div>
            </div>
        </section>
        
        {{-- Wisata Gallery --}}
        <section class="py-10 sm:py-12 md:py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <livewire:wisata-gallery />
            </div>
        </section>
        
        {{-- CTA Section --}}
        <section class="py-12 sm:py-16 md:py-20 bg-gradient-to-r from-primary to-primary-dark">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="font-heading text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-3 sm:mb-4 md:mb-6 leading-tight">
                    Butuh Bantuan?
                </h2>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-200 mb-5 sm:mb-6 md:mb-8 max-w-2xl mx-auto px-2 sm:px-0">
                    Hubungi call center kami untuk informasi lebih lanjut mengenai layanan pemerintah Kabupaten Lombok Timur.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                    <a href="tel:0376123456" class="inline-flex items-center justify-center px-5 sm:px-8 py-3 sm:py-4 bg-accent hover:bg-accent-dark text-white font-bold text-sm sm:text-base md:text-lg rounded-lg transition-colors shadow-lg shadow-accent/30">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="tabular-nums">(0376) 123456</span>
                    </a>
                    <a href="{{ url('/layanan') }}" class="inline-flex items-center justify-center px-5 sm:px-8 py-3 sm:py-4 bg-white/10 hover:bg-white/20 text-white font-bold text-sm sm:text-base md:text-lg rounded-lg transition-colors border-2 border-white/30">
                        Lihat Semua Layanan
                    </a>
                </div>
            </div>
        </section>
    </div>
</x-layouts.app>