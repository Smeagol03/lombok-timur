<header class="bg-primary shadow-lg sticky top-0 z-50">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="{{ url('/') }}" class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                    <span class="text-primary font-heading font-bold text-lg">LT</span>
                </div>
                <div class="hidden sm:block">
                    <span class="text-white font-heading font-bold text-lg">Lombok Timur</span>
                    <span class="text-accent font-heading font-bold text-lg block -mt-1">Kabupaten</span>
                </div>
            </a>
            
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ url('/') }}" class="text-white hover:text-accent px-3 py-2 text-sm font-medium transition-colors">Beranda</a>
                <a href="{{ url('/berita') }}" class="text-white hover:text-accent px-3 py-2 text-sm font-medium transition-colors">Berita</a>
                <a href="{{ url('/pengumuman') }}" class="text-white hover:text-accent px-3 py-2 text-sm font-medium transition-colors">Pengumuman</a>
                <a href="{{ url('/layanan') }}" class="text-white hover:text-accent px-3 py-2 text-sm font-medium transition-colors">Layanan</a>
                <a href="{{ url('/wisata') }}" class="text-white hover:text-accent px-3 py-2 text-sm font-medium transition-colors">Wisata</a>
                <a href="{{ url('/profil') }}" class="text-white hover:text-accent px-3 py-2 text-sm font-medium transition-colors">Profil</a>
            </div>
            
            <div class="hidden md:flex items-center space-x-4">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="text-white hover:text-accent p-2 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-72 bg-white rounded-lg shadow-xl p-3">
                        <form action="{{ url('/pencarian') }}" method="GET">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita, layanan..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-gray-900 text-sm">
                        </form>
                    </div>
                </div>
            </div>
            
            <button @click="mobileMenu = !mobileMenu" class="md:hidden text-white p-2" x-data="{ mobileMenu: false }">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <div x-show="mobileMenu" x-cloak class="md:hidden pb-4">
            <div class="space-y-1">
                <a href="{{ url('/') }}" class="text-white hover:text-accent block px-3 py-2 text-sm font-medium">Beranda</a>
                <a href="{{ url('/berita') }}" class="text-white hover:text-accent block px-3 py-2 text-sm font-medium">Berita</a>
                <a href="{{ url('/pengumuman') }}" class="text-white hover:text-accent block px-3 py-2 text-sm font-medium">Pengumuman</a>
                <a href="{{ url('/layanan') }}" class="text-white hover:text-accent block px-3 py-2 text-sm font-medium">Layanan</a>
                <a href="{{ url('/wisata') }}" class="text-white hover:text-accent block px-3 py-2 text-sm font-medium">Wisata</a>
                <a href="{{ url('/profil') }}" class="text-white hover:text-accent block px-3 py-2 text-sm font-medium">Profil</a>
            </div>
            <div class="mt-3 px-3">
                <form action="{{ url('/pencarian') }}" method="GET">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 text-sm">
                </form>
            </div>
        </div>
    </nav>
</header>
