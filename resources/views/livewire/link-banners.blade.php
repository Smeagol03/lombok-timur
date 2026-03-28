@if($this->banners->count() > 0)
<section class="bg-gray-50 border-t border-gray-200 py-10 lg:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-3">
                <div class="w-10 h-[3px] bg-accent"></div>
                <h2 class="text-lg font-heading font-bold !text-primary tracking-wide uppercase">Tautan & Media Sosial</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($this->banners as $banner)
            <a href="{{ $banner->url }}"
               target="_blank"
               rel="noopener noreferrer"
               class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 border border-gray-200 overflow-hidden hover:-translate-y-1">
                <div class="flex p-5 gap-4">
                    {{-- Icon/Thumbnail --}}
                    <div class="w-16 h-16 shrink-0 rounded-lg overflow-hidden bg-gradient-to-br from-accent/10 to-primary/10 flex items-center justify-center">
                        @if($banner->getFirstMediaUrl('gambar'))
                            <img src="{{ $banner->getFirstMediaUrl('gambar') }}"
                                 alt="{{ $banner->nama }}"
                                 class="w-full h-full object-cover">
                        @elseif($banner->gambar)
                            <img src="{{ $banner->gambar }}"
                                 alt="{{ $banner->nama }}"
                                 class="w-full h-full object-cover">
                        @else
                            @php
                                $icons = [
                                    'facebook' => '<svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
                                    'instagram' => '<svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>',
                                    'twitter' => '<svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
                                    'youtube' => '<svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
                                    'tiktok' => '<svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93v6.16c0 2.52-1.12 4.84-2.9 6.24-1.72 1.39-4.02 1.94-6.18 1.45-2.91-.62-5.2-2.95-5.77-5.86-.58-2.91.68-5.94 3.18-7.58 2.5-1.64 5.82-1.55 8.23.23v4.2c-.97-.87-2.37-1.15-3.6-.71-1.23.44-2.09 1.57-2.15 2.87-.06 1.3.7 2.5 1.88 3.02 1.18.52 2.56.2 3.42-.77.54-.6.83-1.39.81-2.2V.02z"/></svg>',
                                    'whatsapp' => '<svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>',
                                    'telegram' => '<svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>',
                                    'website' => '<svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>',
                                    'email' => '<svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',
                                    'maps' => '<svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>',
                                    'booking' => '<svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>',
                                    'news' => '<svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>',
                                    'link' => '<svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>',
                                ];
                                $iconSvg = $icons[$banner->icon] ?? $icons['link'];
                            @endphp
                            {!! $iconSvg !!}
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <h3 class="font-heading font-bold text-base !text-primary group-hover:text-accent transition-colors line-clamp-1">
                            {{ $banner->nama }}
                        </h3>
                        @if($banner->description)
                        <p class="text-gray-600 text-sm mt-1 line-clamp-2">
                            {{ $banner->description }}
                        </p>
                        @endif
                        <div class="flex items-center gap-2 mt-2 text-accent text-sm font-medium">
                            <span>Kunjungi</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($this->banners->hasPages())
        <div class="mt-8 flex justify-center">
            <nav class="flex items-center gap-2" role="navigation" aria-label="Pagination Navigation">
                {{-- Previous Button --}}
                @if($this->banners->onFirstPage())
                    <span class="px-4 py-2 text-gray-400 text-sm font-medium bg-white rounded-lg border border-gray-200 cursor-not-allowed">
                        Sebelumnya
                    </span>
                @else
                    <button wire:click="previousPage"
                            wire:loading.attr="disabled"
                            class="px-4 py-2 text-primary hover:text-white text-sm font-medium bg-white hover:bg-accent rounded-lg border border-gray-200 hover:border-accent transition-all">
                        Sebelumnya
                    </button>
                @endif

                {{-- Page Numbers --}}
                @foreach($this->banners->getUrlRange(1, $this->banners->lastPage()) as $page => $url)
                    @if($page == $this->banners->currentPage())
                        <span class="px-4 py-2 text-white text-sm font-bold bg-accent rounded-lg border border-accent">
                            {{ $page }}
                        </span>
                    @else
                        <button wire:click="gotoPage({{ $page }})"
                                class="px-4 py-2 text-primary hover:text-white text-sm font-medium bg-white hover:bg-accent rounded-lg border border-gray-200 hover:border-accent transition-all">
                            {{ $page }}
                        </button>
                    @endif
                @endforeach

                {{-- Next Button --}}
                @if($this->banners->hasMorePages())
                    <button wire:click="nextPage"
                            wire:loading.attr="disabled"
                            class="px-4 py-2 text-primary hover:text-white text-sm font-medium bg-white hover:bg-accent rounded-lg border border-gray-200 hover:border-accent transition-all">
                        Berikutnya
                    </button>
                @else
                    <span class="px-4 py-2 text-gray-400 text-sm font-medium bg-white rounded-lg border border-gray-200 cursor-not-allowed">
                        Berikutnya
                    </span>
                @endif
            </nav>
        </div>
        @endif
    </div>
</section>
@endif
