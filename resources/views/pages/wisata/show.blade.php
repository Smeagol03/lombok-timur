<x-layouts.app 
    :title="$title ?? null"
    :description="$description ?? null"
    :keywords="$keywords ?? null"
    :ogImage="$ogImage ?? null"
    :type="$type ?? 'place'">
    
    @isset($jsonLd)
    <x-json-ld
        :type="$jsonLd['type']"
        :title="$jsonLd['title']"
        :description="$jsonLd['description']"
        :image="$jsonLd['image']"
        :url="$jsonLd['url']"
        :address="$jsonLd['address'] ?? null"
        :geo="$jsonLd['geo'] ?? null" />
    @endisset
    
    <div class="min-h-screen bg-background">
        {{-- Hero Section with Gallery --}}
        <div class="relative h-[280px] sm:h-[350px] md:h-[450px] bg-gray-900">
            @if($wisata->getFirstMediaUrl('foto_utama'))
            <img src="{{ $wisata->getFirstMediaUrl('foto_utama') }}" 
                 alt="{{ $wisata->nama }}"
                 class="w-full h-full object-cover">
            @else
            <div class="w-full h-full bg-gradient-to-r from-primary to-primary-dark"></div>
            @endif
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
            
            <div class="absolute bottom-0 left-0 right-0 p-5 sm:p-8 md:p-12">
                <div class="max-w-4xl mx-auto">
                    {{-- Breadcrumb --}}
                    <nav class="flex items-center text-sm !text-white mb-3 sm:mb-4">
                        <a href="{{ url('/') }}" class="!text-white hover:!text-white/80 transition-colors">Beranda</a>
                        <svg class="w-4 h-4 mx-2 !text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <a href="{{ url('/wisata') }}" class="!text-white hover:!text-white/80 transition-colors">Wisata</a>
                        <svg class="w-4 h-4 mx-2 !text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="!text-white">Detail</span>
                    </nav>
                    
                    {{-- Kecamatan Badge --}}
                    <span class="inline-block px-3 py-1 bg-accent text-white text-xs sm:text-sm rounded mb-2 sm:mb-3">
                        {{ $wisata->kecamatan }}
                    </span>
                    
                    {{-- Title --}}
                    <h1 class="font-heading text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white leading-tight drop-shadow-sm">
                        {{ $wisata->nama }}
                    </h1>
                </div>
            </div>
        </div>
        
        {{-- Content Section --}}
        <div class="py-10 sm:py-14">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 sm:p-8 md:p-10">
                    {{-- Location Info --}}
                    <div class="flex items-start gap-3 mb-6 p-4 bg-gray-50 rounded-lg border border-gray-100">
                        <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-900">Lokasi</p>
                            <p class="text-gray-600 text-sm sm:text-base">{{ $wisata->lokasi }}</p>
                            @if($wisata->koordinat_lat && $wisata->koordinat_lng)
                            <a href="https://www.google.com/maps?q={{ $wisata->koordinat_lat }},{{ $wisata->koordinat_lng }}" 
                               target="_blank"
                               class="inline-flex items-center gap-1 mt-2 text-primary hover:text-accent text-sm transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                Lihat di Google Maps
                            </a>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Description --}}
                    <div class="prose prose-lg max-w-none prose-headings:font-heading prose-headings:text-primary">
                        {!! nl2br(e($wisata->deskripsi)) !!}
                    </div>
                    
                    {{-- Gallery --}}
                    @if($wisata->getMedia('galeri')->count() > 0)
                    <div class="mt-8 sm:mt-10 pt-5 sm:pt-6 border-t border-gray-100">
                        <h3 class="font-heading text-lg sm:text-xl font-bold text-primary mb-5 sm:mb-6">Galeri</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4">
                            @foreach($wisata->getMedia('galeri') as $media)
                            <div class="aspect-square rounded-lg overflow-hidden bg-gray-100">
                                <img src="{{ $media->getUrl() }}" 
                                     alt="{{ $wisata->nama }}"
                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        {{-- Related Tourism --}}
        @if(isset($relatedWisata) && $relatedWisata->count() > 0)
        <div class="pb-12 sm:pb-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <h3 class="font-heading text-lg sm:text-xl font-bold text-primary mb-5 sm:mb-6">Wisata Lainnya di {{ $wisata->kecamatan }}</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                    @foreach($relatedWisata as $related)
                    <article class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md hover:border-gray-200 transition-all">
                        <a href="{{ url('/wisata/'.$related->slug) }}">
                            <div class="aspect-video bg-gray-200">
                                @if($related->getFirstMediaUrl('foto_utama'))
                                <img src="{{ $related->getFirstMediaUrl('foto_utama') }}" 
                                     alt="{{ $related->nama }}"
                                     class="w-full h-full object-cover">
                                @else
                                <img src="https://picsum.photos/400/225?random={{ rand() }}"
                                     alt="Placeholder image"
                                     class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="p-4 sm:p-5">
                                <h4 class="font-heading font-semibold text-sm sm:text-base text-gray-900 line-clamp-2 hover:text-accent transition-colors">
                                    {{ $related->nama }}
                                </h4>
                                <p class="text-gray-400 text-xs sm:text-sm mt-2">
                                    {{ $related->kecamatan }}
                                </p>
                            </div>
                        </a>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</x-layouts.app>