<x-layouts.app>
    <div class="min-h-screen bg-background">
        {{-- Hero Section --}}
        <div class="bg-primary py-12">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Breadcrumb --}}
                <nav class="flex items-center text-sm text-primary-200 mb-4">
                    <a href="{{ url('/') }}" class="hover:text-white">Beranda</a>
                    <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="{{ url('/layanan') }}" class="hover:text-white">Layanan</a>
                    <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-white">Detail</span>
                </nav>
                
                {{-- Icon & Title --}}
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                        @if($layanan->getFirstMediaUrl('icon'))
                        <img src="{{ $layanan->getFirstMediaUrl('icon') }}" alt="{{ $layanan->nama }}" class="w-10 h-10 object-contain filter brightness-0 invert">
                        @else
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        @endif
                    </div>
                    
                    <div>
                        <h1 class="font-heading text-2xl md:text-3xl font-bold text-white leading-tight">
                            {{ $layanan->nama }}
                        </h1>
                        @if($layanan->dinas_terkait)
                        <p class="text-primary-200 mt-2">
                            {{ $layanan->dinas_terkait }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Content Section --}}
        <div class="py-12">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-card shadow-sm p-6 md:p-10">
                    {{-- Description --}}
                    <div class="prose prose-lg max-w-none">
                        {!! nl2br(e($layanan->deskripsi)) !!}
                    </div>
                    
                    {{-- External Link Button --}}
                    @if($layanan->url_eksternal)
                    <div class="mt-10 pt-6 border-t border-gray-100">
                        <a href="{{ $layanan->url_eksternal }}" 
                           target="_blank"
                           class="inline-flex items-center justify-center w-full md:w-auto px-6 py-3 bg-primary hover:bg-primary-dark text-white font-medium rounded-lg transition-colors">
                            <span>Akses Layanan</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                        <p class="text-sm text-gray-500 mt-3">
                            Akan dibuka di jendela baru
                        </p>
                    </div>
                    @endif
                    
                    {{-- Related Services --}}
                    @if(isset($relatedServices) && $relatedServices->count() > 0)
                    <div class="mt-10 pt-6 border-t border-gray-100">
                        <h3 class="font-heading text-xl font-bold text-primary mb-6">Layanan Terkait</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($relatedServices as $related)
                            <a href="{{ url('/layanan/'.$related->slug) }}"
                               class="p-4 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                                <h4 class="font-heading font-semibold text-gray-900 hover:text-accent transition-colors">
                                    {{ $related->nama }}
                                </h4>
                                <p class="text-sm text-gray-500 mt-1 line-clamp-2">
                                    {{ Str::limit($related->deskripsi, 60) }}
                                </p>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>