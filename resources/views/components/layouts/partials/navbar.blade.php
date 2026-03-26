<header class="bg-primary shadow-lg sticky top-0 z-50" x-data="navbarComponent()">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-14 sm:h-16">
            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2 sm:gap-3">
                <div class="w-9 h-9 sm:w-10 sm:h-10 bg-white rounded-lg flex items-center justify-center shrink-0">
                    <span class="text-primary font-heading font-bold text-base sm:text-lg">LT</span>
                </div>
                <div class="hidden sm:block">
                    <span class="text-white font-heading font-bold text-base lg:text-lg block leading-tight">Lombok Timur</span>
                    <span class="text-accent font-heading font-bold text-base lg:text-lg block -mt-1">Kabupaten</span>
                </div>
                <span class="sm:hidden text-white font-heading font-bold text-base">Lombok Timur</span>
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center space-x-0.5 xl:space-x-1">
                <a href="{{ url('/') }}" class="text-white hover:text-accent px-2 xl:px-3 py-2 text-sm font-medium transition-colors">Beranda</a>
                <a href="{{ url('/berita') }}" class="text-white hover:text-accent px-2 xl:px-3 py-2 text-sm font-medium transition-colors">Berita</a>
                <a href="{{ url('/pengumuman') }}" class="text-white hover:text-accent px-2 xl:px-3 py-2 text-sm font-medium transition-colors">Pengumuman</a>
                <a href="{{ url('/layanan') }}" class="text-white hover:text-accent px-2 xl:px-3 py-2 text-sm font-medium transition-colors">Layanan</a>
                <a href="{{ url('/wisata') }}" class="text-white hover:text-accent px-2 xl:px-3 py-2 text-sm font-medium transition-colors">Wisata</a>
                <a href="{{ url('/profil') }}" class="text-white hover:text-accent px-2 xl:px-3 py-2 text-sm font-medium transition-colors">Profil</a>
            </div>

            {{-- Right Side Actions --}}
            <div class="flex items-center gap-2">
                {{-- Search Desktop --}}
                <div class="hidden lg:block relative" x-data="{ searchOpen: false }">
                    <button @click="searchOpen = !searchOpen" class="text-white hover:text-accent p-2 transition-colors rounded-lg hover:bg-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                    <div x-show="searchOpen"
                         @click.away="searchOpen = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         x-cloak
                         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl p-3 origin-top-right">
                        <form action="{{ url('/pencarian') }}" method="GET">
                            <div class="relative">
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Cari berita, layanan..."
                                       class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-gray-900 text-sm"
                                       autofocus>
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Search Mobile Button --}}
                <a href="{{ url('/pencarian') }}" class="lg:hidden text-white p-2.5 hover:bg-white/10 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </a>

                {{-- Mobile Menu Toggle Button --}}
                <button type="button"
                        x-show="!mobileMenuOpen"
                        @click="toggleMenu()"
                        class="lg:hidden relative w-10 h-10 flex items-center justify-center text-white hover:bg-white/10 rounded-lg transition-colors z-50"
                        aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu Offcanvas --}}
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-x-full"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 -translate-x-full"
             x-cloak
             class="fixed inset-0 z-40 lg:hidden"
             @click.away="closeMenu()">
            {{-- Overlay --}}
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

            {{-- Offcanvas Panel --}}
            <div class="relative bg-primary w-72 max-w-xs h-full shadow-2xl z-50">
                <div class="flex flex-col h-full">
                    {{-- Header with Close Button --}}
                    <div class="flex items-center justify-between p-4 border-b border-white/10">
                        <span class="text-white font-heading font-bold text-lg">Menu</span>
                        <button @click="closeMenu()"
                                class="text-white hover:text-accent p-2 rounded-lg hover:bg-white/10 transition-colors"
                                aria-label="Close menu">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Navigation Links --}}
                    <div class="flex-1 overflow-y-auto py-4">
                        <div class="space-y-1 px-3">
                            <a href="{{ url('/') }}" @click="closeMenu()" class="flex items-center gap-3 text-white hover:text-accent hover:bg-white/10 px-4 py-3 text-base font-medium rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Beranda
                            </a>
                            <a href="{{ url('/berita') }}" @click="closeMenu()" class="flex items-center gap-3 text-white hover:text-accent hover:bg-white/10 px-4 py-3 text-base font-medium rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-9-10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h2"/>
                                </svg>
                                Berita
                            </a>
                            <a href="{{ url('/pengumuman') }}" @click="closeMenu()" class="flex items-center gap-3 text-white hover:text-accent hover:bg-white/10 px-4 py-3 text-base font-medium rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                </svg>
                                Pengumuman
                            </a>
                            <a href="{{ url('/layanan') }}" @click="closeMenu()" class="flex items-center gap-3 text-white hover:text-accent hover:bg-white/10 px-4 py-3 text-base font-medium rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Layanan
                            </a>
                            <a href="{{ url('/wisata') }}" @click="closeMenu()" class="flex items-center gap-3 text-white hover:text-accent hover:bg-white/10 px-4 py-3 text-base font-medium rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12l-9-9-9 9"/>
                                </svg>
                                Wisata
                            </a>
                            <a href="{{ url('/profil') }}" @click="closeMenu()" class="flex items-center gap-3 text-white hover:text-accent hover:bg-white/10 px-4 py-3 text-base font-medium rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Profil
                            </a>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="border-t border-white/10 p-4">
                        <p class="text-gray-400 text-xs text-center">
                            &copy; {{ date('Y') }} Kab. Lombok Timur
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </nav>
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
