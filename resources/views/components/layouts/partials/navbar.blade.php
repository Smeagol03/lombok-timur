<!-- Main Navigation - Swiss Clean Style -->
<header class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm" x-data="navbarComponent()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-14 sm:h-16">
            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2 sm:gap-3">
                @if($setting && $setting->getFirstMediaUrl('logo'))
                    <img src="{{ $setting->getFirstMediaUrl('logo') }}"
                         alt="{{ $setting->site_name }}"
                         class="h-10 sm:h-11 w-auto object-contain">
                @else
                    <div class="w-10 h-10 sm:w-11 sm:h-11 bg-primary rounded-lg flex items-center justify-center shrink-0">
                        <span class="text-white font-heading font-bold text-base sm:text-lg">LT</span>
                    </div>
                @endif
                <div class="hidden sm:block">
                    <span class="text-primary font-heading font-bold text-base lg:text-lg block leading-tight">{{ $setting?->site_name ?? 'Lombok Timur' }}</span>
                </div>
            </a>

            {{-- Desktop Navigation - Clean & Minimal --}}
            <nav class="hidden lg:flex items-center gap-1">
                <a href="{{ url('/') }}"
                   class="px-4 py-2 text-sm font-medium rounded-md transition-colors {{ request()->is('/') ? 'bg-primary !text-white' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }}">
                    Beranda
                </a>
                <a href="{{ url('/berita') }}"
                   class="px-4 py-2 text-sm font-medium rounded-md transition-colors {{ request()->is('berita*') ? 'bg-primary !text-white' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }}">
                    Berita
                </a>
                <a href="{{ url('/pengumuman') }}"
                   class="px-4 py-2 text-sm font-medium rounded-md transition-colors {{ request()->is('pengumuman*') ? 'bg-primary !text-white' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }}">
                    Pengumuman
                </a>
                <a href="{{ url('/layanan') }}"
                   class="px-4 py-2 text-sm font-medium rounded-md transition-colors {{ request()->is('layanan*') ? 'bg-primary !text-white' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }}">
                    Layanan
                </a>
                <a href="{{ url('/wisata') }}"
                   class="px-4 py-2 text-sm font-medium rounded-md transition-colors {{ request()->is('wisata*') ? 'bg-primary !text-white' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }}">
                    Wisata
                </a>
                <a href="{{ url('/profil') }}"
                   class="px-4 py-2 text-sm font-medium rounded-md transition-colors {{ request()->is('profil*') ? 'bg-primary !text-white' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }}">
                    Profil
                </a>
            </nav>

            {{-- Right Side Actions --}}
            <div class="flex items-center gap-2">
                {{-- Search Desktop --}}
                <div class="hidden lg:block relative" x-data="{ searchOpen: false }">
                    <button @click="searchOpen = !searchOpen"
                            class="p-2 text-gray-600 hover:text-primary hover:bg-gray-100 rounded-md transition-colors"
                            aria-label="Search">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                    <div x-show="searchOpen"
                         @click.away="searchOpen = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         x-cloak
                         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 p-3 origin-top-right">
                        <form action="{{ url('/pencarian') }}" method="GET">
                            <div class="relative">
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Cari berita, layanan..."
                                       class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-md focus:ring-2 focus:ring-primary focus:border-transparent text-sm"
                                       autofocus>
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Search Mobile Button --}}
                <a href="{{ url('/pencarian') }}"
                   class="lg:hidden p-2 text-gray-600 hover:text-primary hover:bg-gray-100 rounded-md transition-colors"
                   aria-label="Search">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </a>

                {{-- Mobile Menu Toggle Button --}}
                <button type="button"
                        x-show="!mobileMenuOpen"
                        @click="toggleMenu()"
                        class="lg:hidden relative w-10 h-10 flex items-center justify-center text-gray-700 hover:text-primary hover:bg-gray-100 rounded-md transition-colors z-50"
                        aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu Offcanvas --}}
    <div x-show="mobileMenuOpen"
         class="fixed inset-0 z-[60] lg:hidden"
         x-cloak>

        {{-- Overlay - Fade In --}}
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="closeMenu()"
             class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

        {{-- Offcanvas Panel - Slide from Left --}}
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="absolute left-0 top-0 bg-white w-80 max-w-[85vw] h-full shadow-2xl z-50 overflow-hidden">
            <div class="flex flex-col h-full">
                {{-- Header with Close Button --}}
                <div class="flex items-center justify-between p-5 border-b border-gray-100 bg-gray-50/50">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-primary rounded flex items-center justify-center">
                            <span class="text-white font-bold text-xs uppercase">LT</span>
                        </div>
                        <span class="text-primary font-heading font-black text-base tracking-tight">MENU UTAMA</span>
                    </div>
                    <button @click="closeMenu()"
                            class="p-2 text-gray-500 hover:text-primary hover:bg-gray-100 rounded-md transition-colors"
                            aria-label="Close menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Navigation Links - Swiss Clean List --}}
                <nav class="flex-1 overflow-y-auto py-6">
                    <div class="space-y-1 px-4">
                        <a href="{{ url('/') }}"
                           @click="closeMenu()"
                           class="flex items-center justify-between px-4 py-4 text-sm font-bold rounded-md transition-all {{ request()->is('/') ? 'bg-primary !text-white translate-x-1' : 'text-gray-900 hover:bg-gray-50 hover:text-primary' }}">
                            <span>Beranda</span>
                            <svg class="w-4 h-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ url('/berita') }}"
                           @click="closeMenu()"
                           class="flex items-center justify-between px-4 py-4 text-sm font-bold rounded-md transition-all {{ request()->is('berita*') ? 'bg-primary !text-white translate-x-1' : 'text-gray-900 hover:bg-gray-50 hover:text-primary' }}">
                            <span>Berita</span>
                            <svg class="w-4 h-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ url('/pengumuman') }}"
                           @click="closeMenu()"
                           class="flex items-center justify-between px-4 py-4 text-sm font-bold rounded-md transition-all {{ request()->is('pengumuman*') ? 'bg-primary !text-white translate-x-1' : 'text-gray-900 hover:bg-gray-50 hover:text-primary' }}">
                            <span>Pengumuman</span>
                            <svg class="w-4 h-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ url('/layanan') }}"
                           @click="closeMenu()"
                           class="flex items-center justify-between px-4 py-4 text-sm font-bold rounded-md transition-all {{ request()->is('layanan*') ? 'bg-primary !text-white translate-x-1' : 'text-gray-900 hover:bg-gray-50 hover:text-primary' }}">
                            <span>Layanan</span>
                            <svg class="w-4 h-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ url('/wisata') }}"
                           @click="closeMenu()"
                           class="flex items-center justify-between px-4 py-4 text-sm font-bold rounded-md transition-all {{ request()->is('wisata*') ? 'bg-primary !text-white translate-x-1' : 'text-gray-900 hover:bg-gray-50 hover:text-primary' }}">
                            <span>Wisata</span>
                            <svg class="w-4 h-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ url('/profil') }}"
                           @click="closeMenu()"
                           class="flex items-center justify-between px-4 py-4 text-sm font-bold rounded-md transition-all {{ request()->is('profil*') ? 'bg-primary !text-white translate-x-1' : 'text-gray-900 hover:bg-gray-50 hover:text-primary' }}">
                            <span>Profil</span>
                            <svg class="w-4 h-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </nav>

                {{-- Footer --}}
                <div class="border-t border-gray-100 p-6 bg-gray-50/30">
                    <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest text-center">
                        &copy; {{ date('Y') }} PEMKAB LOMBOK TIMUR
                    </p>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
function navbarComponent() {
    return {
        mobileMenuOpen: false,
        toggleMenu() {
            this.mobileMenuOpen = !this.mobileMenuOpen;
            if (this.mobileMenuOpen) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        },
        closeMenu() {
            this.mobileMenuOpen = false;
            document.body.style.overflow = '';
        }
    }
}
</script>
