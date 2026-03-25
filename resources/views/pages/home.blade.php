<x-layouts.app>
    <div class="min-h-screen bg-background">
        {{-- Hero Slider --}}
        <section>
            <livewire:hero-slider />
        </section>
        
        {{-- Quick Access / Layanan --}}
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-4">
                        Layanan Publik
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Akses berbagai layanan pemerintah Kabupaten Lombok Timur dengan mudah dan cepat.
                    </p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    @foreach(\App\Models\Layanan::active()->ordered()->limit(5)->get() as $layanan)
                    <a href="{{ $layanan->url_eksternal ?: url('/layanan/'.$layanan->slug) }}" 
                       class="bg-white rounded-card p-6 shadow-md hover:shadow-lg transition-all text-center group border border-gray-100 hover:border-accent/30">
                        <div class="w-16 h-16 bg-primary/10 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-accent/20 transition-colors">
                            <svg class="w-8 h-8 text-primary group-hover:text-accent transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="font-heading font-semibold text-gray-900 mb-2 group-hover:text-accent transition-colors">{{ $layanan->nama }}</h3>
                        <p class="text-gray-500 text-sm line-clamp-2">{{ Str::limit($layanan->deskripsi, 60) }}</p>
                    </a>
                    @endforeach
                </div>
                
                <div class="mt-10 text-center">
                    <a href="{{ url('/layanan') }}" class="inline-flex items-center px-6 py-3 border-2 border-primary text-primary font-semibold rounded-button hover:bg-primary hover:text-white transition-colors">
                        Semua Layanan
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
        
        {{-- Berita Terbaru --}}
        <section class="py-16 bg-background">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <livewire:berita-terbaru />
            </div>
        </section>
        
        {{-- Agenda Kegiatan --}}
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <livewire:agenda-kegiatan />
            </div>
        </section>
        
        {{-- Data Publik: Harga Pokok & Stok Darah --}}
        <section class="py-16 bg-background">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <livewire:harga-pokok />
                    <livewire:stok-darah />
                </div>
            </div>
        </section>
        
        {{-- Wisata Gallery --}}
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <livewire:wisata-gallery />
            </div>
        </section>
        
        {{-- CTA Section --}}
        <section class="py-20 bg-gradient-to-r from-primary to-primary-dark">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="font-heading text-3xl md:text-4xl font-bold text-white mb-6">
                    Butuh Bantuan?
                </h2>
                <p class="text-xl text-gray-200 mb-8">
                    Hubungi call center kami untuk informasi lebih lanjut mengenai layanan pemerintah Kabupaten Lombok Timur.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="tel:0376123456" class="inline-flex items-center justify-center px-8 py-4 bg-accent hover:bg-accent-dark text-white font-bold text-lg rounded-button transition-colors">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        (0376) 123456
                    </a>
                    <a href="{{ url('/layanan') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-bold text-lg rounded-button transition-colors border-2 border-white/30">
                        Lihat Semua Layanan
                    </a>
                </div>
            </div>
        </section>
    </div>
</x-layouts.app>
