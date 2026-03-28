<x-layouts.app
    title="Profil Kabupaten Lombok Timur"
    description="Profil dan informasi umum Kabupaten Lombok Timur, Nusa Tenggara Barat. Sejarah, visi misi, dan struktur pemerintahan."
    keywords="profil lombok timur, tentang lombok timur, pemerintah daerah, ntb">
    <div class="min-h-screen bg-background">
        {{-- Hero Section - Swiss Modern Design --}}
        <section class="bg-primary py-20 md:py-28 relative overflow-hidden">
            {{-- Abstract Geometric Pattern --}}
            <div class="absolute inset-0 opacity-5">
                <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-white rounded-full blur-2xl transform -translate-x-1/3 translate-y-1/3"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                    {{-- Main Content - Left Side --}}
                    <div class="lg:col-span-8">
                        {{-- Breadcrumb Style Label --}}
                        <div class="flex items-center gap-3 mb-6">
                            <div class="h-px w-8 bg-white/40"></div>
                            <span class="text-xs font-medium tracking-[0.2em] text-white/50 uppercase">Profil Daerah</span>
                        </div>

                        {{-- Title - Bold Typography with Varied Weights --}}
                        <h1 class="font-sans text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold !text-white tracking-tight leading-[0.95]">
                            PROFIL<br>
                            <span class="font-light text-white">KABUPATEN</span><br>
                            <span class="text-yellow-500">LOMBOK TIMUR</span>
                        </h1>

                        {{-- Description --}}
                        <p class="text-white/70 mt-8 text-base md:text-lg max-w-2xl leading-relaxed">
                            Informasi tentang pemerintahan, visi misi, dan struktur organisasi Kabupaten Lombok Timur.
                            Mengenal lebih dekat sejarah, potensi, dan arah pembangunan daerah.
                        </p>
                    </div>

                    {{-- Visual Panel - Right Side --}}
                    <div class="lg:col-span-4">
                        <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 h-full">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xs font-medium tracking-widest text-white/60 uppercase">Informasi</span>
                                <svg class="w-5 h-5 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>

                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 bg-accent rounded-full"></div>
                                    <span class="text-sm text-white/80">20 Kecamatan</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 bg-accent rounded-full"></div>
                                    <span class="text-sm text-white/80">1.605 km² Luas Wilayah</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 bg-accent rounded-full"></div>
                                    <span class="text-sm text-white/80">1.3jt+ Penduduk</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 bg-accent rounded-full"></div>
                                    <span class="text-sm text-white/80">Ibu Kota: Selong</span>
                                </div>
                            </div>

                            {{-- Decorative Element --}}
                            <div class="mt-8 pt-6 border-t border-white/20">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-1 bg-accent rounded-full"></div>
                                    <div class="w-4 h-1 bg-white/30 rounded-full"></div>
                                    <div class="w-2 h-1 bg-white/20 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Content Section --}}
        <div class="py-12">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-card shadow-sm p-8 md:p-12">
                    {{-- Overview --}}
                    <section class="mb-12">
                        <h2 class="font-heading text-2xl font-bold text-primary mb-4">Gambaran Umum</h2>
                        <div class="prose prose-lg text-gray-600 max-w-none">
                            <p>
                                Kabupaten Lombok Timur merupakan salah satu daerah tingkat II di Provinsi Nusa Tenggara Barat, Indonesia.
                                Ibu kota kabupaten ini terletak di Selong. Lombok Timur memiliki luas wilayah sekitar 1.605,55 km²
                                dengan jumlah penduduk lebih dari 1,3 juta jiwa.
                            </p>
                            <p>
                                Kabupaten ini terdiri dari 20 kecamatan dan memiliki potensi ekonomi yang beragam, mulai dari pertanian,
                                pariwisata, hingga perikanan. Salah satu destinasi wisata terkenal di Lombok Timur adalah Gunung Rinjani
                                yang merupakan gunung berapi tertinggi kedua di Indonesia.
                            </p>
                        </div>
                    </section>

                    {{-- Vision & Mission - Swiss Style --}}
                    <section class="mb-24">
                        {{-- Section Header: Swiss Layout --}}
                        <div class="flex flex-col md:flex-row items-baseline gap-4 border-b-4 border-primary pb-6 mb-16">
                            <span class="font-heading text-6xl md:text-8xl font-black text-primary/10 leading-none select-none">01</span>
                            <div class="flex flex-col">
                                <h2 class="font-heading text-4xl md:text-6xl font-black text-primary uppercase tracking-tighter leading-none">Visi <span class="text-accent">&</span> Misi</h2>
                                <p class="text-gray-500 font-medium mt-2 tracking-widest uppercase text-xs">Kabupaten Lombok Timur / Arah Pembangunan</p>
                            </div>
                        </div>

                        {{-- Vision: Asymmetric Typography --}}
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-14 md:mb-24 items-start">
                            <div class="lg:col-span-4 border-l-2 border-accent pl-6">
                                <h3 class="font-heading text-sm font-bold uppercase tracking-[0.3em] text-accent mb-4">Visi Utama Daerah</h3>
                                <p class="text-gray-500 text-sm leading-relaxed">
                                    Sebuah pernyataan tujuan jangka panjang yang menjadi kompas dalam setiap kebijakan dan langkah strategis pemerintahan.
                                </p>
                            </div>
                            <div class="lg:col-span-8">
                                <p class="font-heading text-3xl md:text-6xl font-black text-primary leading-[0.9] tracking-tighter">
                                    TERWUJUDNYA KABUPATEN LOMBOK TIMUR YANG <span class="text-accent">MAJU</span>, <span class="text-accent">MANDIRI</span>, DAN <span class="text-accent">BERKEADILAN</span>.
                                </p>
                            </div>
                        </div>

                        {{-- Mission: Grid-based Systematic List --}}
                        <div class="border-t border-gray-200">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                                {{-- Mission 1 --}}
                                <div class="border-b border-gray-200 md:border-r p-8 md:p-12 hover:bg-primary group transition-colors duration-300">
                                    <span class="block font-heading text-xs font-bold text-accent mb-12 group-hover:text-white/60 tracking-[0.2em] uppercase">Misi — 01</span>
                                    <h4 class="font-heading text-2xl font-black text-primary mb-6 group-hover:text-white leading-tight uppercase tracking-tight">Kualitas SDM</h4>
                                    <p class="text-gray-600 group-hover:text-white/80 leading-relaxed text-sm">
                                        Meningkatkan kualitas sumber daya manusia yang berdaya saing melalui penguatan sistem pendidikan dan kesehatan.
                                    </p>
                                </div>

                                {{-- Mission 2 --}}
                                <div class="border-b border-gray-200 lg:border-r p-8 md:p-12 hover:bg-primary group transition-colors duration-300">
                                    <span class="block font-heading text-xs font-bold text-accent mb-12 group-hover:text-white/60 tracking-[0.2em] uppercase">Misi — 02</span>
                                    <h4 class="font-heading text-2xl font-black text-primary mb-6 group-hover:text-white leading-tight uppercase tracking-tight">Kemandirian Ekonomi</h4>
                                    <p class="text-gray-600 group-hover:text-white/80 leading-relaxed text-sm">
                                        Mewujudkan perekonomian yang mandiri berbasis pada sektor unggulan pertanian dan pariwisata daerah.
                                    </p>
                                </div>

                                {{-- Mission 3 --}}
                                <div class="border-b border-gray-200 md:border-r lg:border-r-0 p-8 md:p-12 hover:bg-primary group transition-colors duration-300">
                                    <span class="block font-heading text-xs font-bold text-accent mb-12 group-hover:text-white/60 tracking-[0.2em] uppercase">Misi — 03</span>
                                    <h4 class="font-heading text-2xl font-black text-primary mb-6 group-hover:text-white leading-tight uppercase tracking-tight">Pelayanan Publik</h4>
                                    <p class="text-gray-600 group-hover:text-white/80 leading-relaxed text-sm">
                                        Meningkatkan kualitas pelayanan publik yang profesional, transparan, dan akuntabel bagi seluruh masyarakat.
                                    </p>
                                </div>

                                {{-- Mission 4 --}}
                                <div class="border-b border-gray-200 lg:border-r p-8 md:p-12 hover:bg-primary group transition-colors duration-300">
                                    <span class="block font-heading text-xs font-bold text-accent mb-12 group-hover:text-white/60 tracking-[0.2em] uppercase">Misi — 04</span>
                                    <h4 class="font-heading text-2xl font-black text-primary mb-6 group-hover:text-white leading-tight uppercase tracking-tight">Tata Kelola</h4>
                                    <p class="text-gray-600 group-hover:text-white/80 leading-relaxed text-sm">
                                        Memperkuat tata kelola pemerintahan yang baik dan bersih (Good & Clean Governance).
                                    </p>
                                </div>

                                {{-- Mission 5 --}}
                                <div class="border-b border-gray-200 md:border-r p-8 md:p-12 hover:bg-primary group transition-colors duration-300 lg:col-span-2">
                                    <div class="max-w-md">
                                        <span class="block font-heading text-xs font-bold text-accent mb-12 group-hover:text-white/60 tracking-[0.2em] uppercase">Misi — 05</span>
                                        <h4 class="font-heading text-2xl font-black text-primary mb-6 group-hover:text-white leading-tight uppercase tracking-tight">Pembangunan Infrastruktur</h4>
                                        <p class="text-gray-600 group-hover:text-white/80 leading-relaxed text-sm">
                                            Meningkatkan pembangunan infrastruktur yang merata dan berkualitas di seluruh wilayah Kabupaten Lombok Timur.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- Contact Info - Swiss Style --}}
                    <section>
                        <div class="flex items-baseline gap-4 border-b-4 border-primary pb-6 mb-8">
                            <span class="font-heading text-6xl md:text-8xl font-black text-primary/10 leading-none select-none">02</span>
                            <div class="flex flex-col">
                                <h2 class="font-heading text-3xl md:text-4xl font-black text-primary uppercase tracking-tighter">Kontak <span class="text-accent">&</span> Informasi</h2>
                                <p class="text-gray-500 font-medium mt-1 tracking-widest uppercase text-xs">Pemerintah Kabupaten Lombok Timur</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-primary text-sm uppercase tracking-wide mb-2">Alamat</h3>
                                        <p class="text-gray-600 text-sm leading-relaxed">Jl. Pejanggik No. 70, Selong, Lombok Timur, NTB 83618</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-primary text-sm uppercase tracking-wide mb-2">Email</h3>
                                        <p class="text-gray-600 text-sm leading-relaxed">info@lomboktimurkab.go.id</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-primary text-sm uppercase tracking-wide mb-2">Telepon</h3>
                                        <p class="text-gray-600 text-sm leading-relaxed">(0376) 21450</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-primary text-sm uppercase tracking-wide mb-2">Jam Operasional</h3>
                                        <p class="text-gray-600 text-sm leading-relaxed">Senin - Jumat: 08:00 - 16:00 WITA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
