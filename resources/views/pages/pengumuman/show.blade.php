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
                    <a href="{{ url('/pengumuman') }}" class="hover:text-white">Pengumuman</a>
                    <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-white">Detail</span>
                </nav>
                
                {{-- Badges --}}
                <div class="flex flex-wrap gap-2 mb-4">
                    @if($pengumuman->is_penting)
                    <span class="px-3 py-1 text-sm font-medium bg-red-500 text-white rounded-full">
                        Pengumuman Penting
                    </span>
                    @endif
                    <span class="px-3 py-1 text-sm font-medium bg-white/20 text-white rounded-full">
                        {{ $pengumuman->tanggal_terbit->format('d M Y') }}
                    </span>
                </div>
                
                {{-- Title --}}
                <h1 class="font-heading text-2xl md:text-3xl font-bold text-white leading-tight">
                    {{ $pengumuman->judul }}
                </h1>
            </div>
        </div>
        
        {{-- Content Section --}}
        <div class="py-12">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-card shadow-sm p-6 md:p-10">
                    {{-- Validity Info --}}
                    @if($pengumuman->tanggal_kadaluarsa)
                    <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-yellow-800">
                                @if($pengumuman->tanggal_kadaluarsa->isFuture())
                                    Berlaku hingga: {{ $pengumuman->tanggal_kadaluarsa->format('d M Y') }}
                                @else
                                    <span class="font-medium">Pengumuman ini sudah kadaluarsa sejak {{ $pengumuman->tanggal_kadaluarsa->format('d M Y') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    @endif
                    
                    {{-- Content --}}
                    <article class="prose prose-lg max-w-none">
                        {!! $pengumuman->konten !!}
                    </article>
                    
                    {{-- Attachments --}}
                    @if($pengumuman->getMedia('lampiran')->count() > 0)
                    <div class="mt-10 pt-6 border-t border-gray-100">
                        <h3 class="font-heading font-semibold text-gray-900 mb-4">Lampiran</h3>
                        <div class="space-y-3">
                            @foreach($pengumuman->getMedia('lampiran') as $media)
                            <a href="{{ $media->getUrl() }}" 
                               target="_blank"
                               class="flex items-center gap-3 p-4 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $media->name }}</p>
                                    <p class="text-sm text-gray-500">{{ number_format($media->size / 1024, 1) }} KB</p>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    {{-- Share Section --}}
                    <div class="mt-10 pt-6 border-t border-gray-100">
                        <p class="text-sm font-medium text-gray-700 mb-3">Bagikan pengumuman:</p>
                        <div class="flex gap-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                               target="_blank"
                               class="w-10 h-10 bg-blue-600 hover:bg-blue-700 rounded-lg flex items-center justify-center text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($pengumuman->judul) }}" 
                               target="_blank"
                               class="w-10 h-10 bg-sky-500 hover:bg-sky-600 rounded-lg flex items-center justify-center text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($pengumuman->judul . ' - ' . url()->current()) }}" 
                               target="_blank"
                               class="w-10 h-10 bg-green-500 hover:bg-green-600 rounded-lg flex items-center justify-center text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>