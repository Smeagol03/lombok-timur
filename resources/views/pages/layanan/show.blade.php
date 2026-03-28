<x-layouts.app
    :title="$title ?? null"
    :description="$description ?? null"
    :keywords="$keywords ?? null"
    :ogImage="$ogImage ?? null"
    :type="$type ?? 'website'">
    
    @isset($jsonLd)
    <x-json-ld
        :type="$jsonLd['type']"
        :title="$jsonLd['title']"
        :description="$jsonLd['description']"
        :url="$jsonLd['url']"
        :telephone="$jsonLd['telephone'] ?? null" />
    @endisset
    
    <div class="min-h-screen bg-background">
        {{-- Hero Section --}}
        <div class="bg-primary py-10 sm:py-14">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Breadcrumb --}}
                <nav class="flex items-center text-sm !text-white mb-4">
                    <a href="{{ url('/') }}" class="!text-white hover:!text-white/80 transition-colors">Beranda</a>
                    <svg class="w-4 h-4 mx-2 !text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="{{ url('/layanan') }}" class="!text-white hover:!text-white/80 transition-colors">Layanan</a>
                    <svg class="w-4 h-4 mx-2 !text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="!text-white">Detail</span>
                </nav>

                {{-- Icon & Title --}}
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                        @if($layanan->icon_type === 'image' && $layanan->getFirstMediaUrl('icon'))
                            <img src="{{ $layanan->getFirstMediaUrl('icon') }}" alt="{{ $layanan->nama }}" class="w-8 h-8 sm:w-10 sm:h-10 object-contain filter brightness-0 invert">
                        @elseif($layanan->icon_type === 'icon' && $layanan->icon)
                            @svg($layanan->icon, 'w-7 h-7 sm:w-8 sm:h-8 text-white')
                        @else
                            @svg('heroicon-o-information-circle', 'w-7 h-7 sm:w-8 sm:h-8 text-white')
                        @endif
                    </div>

                    <div>
                        <h1 class="font-heading text-xl sm:text-2xl md:text-3xl font-bold !text-white leading-tight">
                            {{ $layanan->nama }}
                        </h1>
                        @if($layanan->dinas_terkait)
                        <p class="!text-white/80 mt-1 sm:mt-2 text-sm sm:text-base">
                            {{ $layanan->dinas_terkait }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Content Section --}}
        <div class="py-10 sm:py-14">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 sm:p-8 md:p-10">
                    {{-- Description --}}
                    <div class="prose prose-lg max-w-none">
                        @sanitized($layanan->deskripsi)
                    </div>

                    {{-- External Link Button --}}
                    @if($layanan->url_eksternal)
                    <div class="mt-8 sm:mt-10 pt-5 sm:pt-6 border-t border-gray-100">
                        <a href="{{ $layanan->url_eksternal }}"
                           target="_blank"
                           class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-6 py-3 bg-primary hover:bg-primary-dark text-white font-medium rounded-lg transition-all hover:shadow-lg">
                            <span>Akses Layanan</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <div class="mt-8 sm:mt-10 pt-5 sm:pt-6 border-t border-gray-100">
                        <h3 class="font-heading text-lg sm:text-xl font-bold text-primary mb-5 sm:mb-6">Layanan Terkait</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4">
                            @foreach($relatedServices as $related)
                            <a href="{{ url('/layanan/'.$related->slug) }}"
                               class="p-4 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors border border-gray-100 hover:border-gray-200">
                                <h4 class="font-heading font-semibold text-sm sm:text-base text-gray-900 hover:text-accent transition-colors">
                                    {{ $related->nama }}
                                </h4>
                                <p class="text-xs sm:text-sm text-gray-500 mt-1 line-clamp-2">
                                    {{ Str::limit(strip_tags($related->deskripsi), 60) }}
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
