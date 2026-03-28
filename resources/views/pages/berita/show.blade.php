<x-layouts.app
    :title="$title ?? null"
    :description="$description ?? null"
    :keywords="$keywords ?? null"
    :ogImage="$ogImage ?? null"
    :type="$type ?? 'article'"
    :publishedTime="$publishedTime ?? null"
    :modifiedTime="$modifiedTime ?? null"
    :section="$section ?? null"
    :author="$author ?? null">
    
    @isset($jsonLd)
    <x-json-ld
        :type="$jsonLd['type']"
        :title="$jsonLd['title']"
        :description="$jsonLd['description']"
        :image="$jsonLd['image']"
        :url="$jsonLd['url']"
        :datePublished="$jsonLd['datePublished'] ?? null"
        :dateModified="$jsonLd['dateModified'] ?? null"
        :author="$jsonLd['author'] ?? null" />
    @endisset
    
    <div class="min-h-screen bg-background">
        {{-- Hero Section with Featured Image --}}
        <div class="relative h-[280px] sm:h-[350px] md:h-[400px] bg-gray-900">
            @if($berita->getFirstMediaUrl('thumbnail'))
            <img src="{{ $berita->getFirstMediaUrl('thumbnail') }}"
                 alt="{{ $berita->judul }}"
                 class="w-full h-full object-cover opacity-70">
            @else
            <img src="https://picsum.photos/1200/400?random={{ $berita->id }}"
                 alt="{{ $berita->judul }}"
                 class="w-full h-full object-cover opacity-70">
            @endif

            <div class="absolute inset-0 bg-linear-to-t from-black/80 via-black/30 to-transparent"></div>

            <div class="absolute bottom-0 left-0 right-0 p-5 sm:p-8 md:p-12">
                <div class="max-w-4xl mx-auto">
                    {{-- Breadcrumb --}}
                    <nav class="flex items-center text-sm !text-white mb-4">
                        <a href="{{ url('/') }}" class="!text-white hover:!text-white/80 transition-colors">Beranda</a>
                        <svg class="w-4 h-4 mx-2 !text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <a href="{{ url('/berita') }}" class="!text-white hover:!text-white/80 transition-colors">Berita</a>
                        <svg class="w-4 h-4 mx-2 !text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="!text-white">Detail</span>
                    </nav>

                    {{-- Category & Date --}}
                    <div class="flex flex-wrap items-center gap-3 mb-3">
                        <span class="px-3 py-1 text-xs sm:text-sm font-medium rounded" style="background-color: {{ $berita->kategori->warna ?? '#C8960C' }}; color: white;">
                            {{ $berita->kategori->nama ?? 'Umum' }}
                        </span>
                        <span class="text-gray-300 text-xs sm:text-sm">
                            {{ $berita->published_at->format('d M Y') }}
                        </span>
                        <span class="text-gray-400 text-xs sm:text-sm flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{ number_format($berita->views) }}x
                        </span>
                    </div>

                    {{-- Title --}}
                    <h1 class="font-heading text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold !text-white leading-tight drop-shadow-sm">
                        {{ $berita->judul }}
                    </h1>
                </div>
            </div>
        </div>

        {{-- Content Section --}}
        <div class="py-10 sm:py-14">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 sm:p-8 md:p-10">
                    {{-- Author Info --}}
                    <div class="flex items-center gap-3 sm:gap-4 pb-5 sm:pb-6 mb-5 sm:mb-6 border-b border-gray-100">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-primary rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base">
                            {{ strtoupper(substr($berita->penulis->name ?? 'A', 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm sm:text-base">{{ $berita->penulis->name ?? 'Admin' }}</p>
                            <p class="text-xs sm:text-sm text-gray-500">Penulis</p>
                        </div>
                    </div>

                    {{-- Article Content --}}
                    <article class="prose prose-lg max-w-none prose-headings:font-heading prose-headings:text-primary prose-a:text-accent hover:prose-a:text-accent-dark">
                        @sanitized($berita->konten)
                    </article>

                    {{-- Share Section --}}
                    <div class="mt-8 sm:mt-10 pt-5 sm:pt-6 border-t border-gray-100">
                        <p class="text-sm font-medium text-gray-700 mb-3">Bagikan:</p>
                        <div class="flex gap-2 sm:gap-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                               target="_blank"
                               class="w-9 h-9 sm:w-10 sm:h-10 bg-blue-600 hover:bg-blue-700 rounded-lg flex items-center justify-center text-white transition-all hover:scale-110">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($berita->judul) }}"
                               target="_blank"
                               class="w-9 h-9 sm:w-10 sm:h-10 bg-sky-500 hover:bg-sky-600 rounded-lg flex items-center justify-center text-white transition-all hover:scale-110">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($berita->judul . ' ' . url()->current()) }}"
                               target="_blank"
                               class="w-9 h-9 sm:w-10 sm:h-10 bg-green-500 hover:bg-green-600 rounded-lg flex items-center justify-center text-white transition-all hover:scale-110">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related News --}}
        @if(isset($relatedNews) && $relatedNews->count() > 0)
        <div class="pb-12 sm:pb-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <h3 class="font-heading text-lg sm:text-xl font-bold text-primary mb-5 sm:mb-6">Berita Terkait</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                    @foreach($relatedNews as $related)
                    <article class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md hover:border-gray-200 transition-all">
                        <a href="{{ url('/berita/'.$related->slug) }}" class="block">
                            <div class="aspect-video bg-gray-200">
                                @if($related->getFirstMediaUrl('thumbnail'))
                                <img src="{{ $related->getFirstMediaUrl('thumbnail') }}"
                                     alt="{{ $related->judul }}"
                                     class="w-full h-full object-cover">
                                @else
                                <img src="https://picsum.photos/400/225?random={{ rand() }}"
                                     alt="Placeholder image"
                                     class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="p-4 sm:p-5">
                                <h4 class="font-heading font-semibold text-sm sm:text-base text-gray-900 line-clamp-2 hover:text-accent transition-colors">
                                    {{ $related->judul }}
                                </h4>
                                <p class="text-gray-400 text-xs sm:text-sm mt-2">
                                    {{ $related->published_at->format('d M Y') }}
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
