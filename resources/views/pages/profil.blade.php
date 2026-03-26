<x-layouts.app>
    <div class="min-h-screen bg-background">
        {{-- Hero Section --}}
        <div class="bg-primary py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="font-heading text-3xl md:text-4xl font-bold text-white mb-4">
                    Profil Kabupaten Lombok Timur
                </h1>
                <p class="text-primary-200 max-w-2xl mx-auto">
                    Informasi tentang pemerintahan, visi misi, dan struktur organisasi Kabupaten Lombok Timur.
                </p>
            </div>
        </div>

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

                    {{-- Quick Stats --}}
                    <section class="mb-12">
                        <h2 class="font-heading text-2xl font-bold text-primary mb-6">Data Umum</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-primary/5 rounded-lg p-6 text-center">
                                <svg class="w-8 h-8 text-primary mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <p class="text-3xl font-bold text-primary mb-1">20</p>
                                <p class="text-gray-600">Kecamatan</p>
                            </div>
                            <div class="bg-primary/5 rounded-lg p-6 text-center">
                                <svg class="w-8 h-8 text-primary mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                                </svg>
                                <p class="text-3xl font-bold text-primary mb-1">1.605</p>
                                <p class="text-gray-600">km² Luas Wilayah</p>
                            </div>
                            <div class="bg-primary/5 rounded-lg p-6 text-center">
                                <svg class="w-8 h-8 text-primary mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <p class="text-3xl font-bold text-primary mb-1">1.3jt+</p>
                                <p class="text-gray-600">Penduduk</p>
                            </div>
                        </div>
                    </section>

                    {{-- Contact Info --}}
                    <section>
                        <h2 class="font-heading text-2xl font-bold text-primary mb-4">Kontak</h2>
                        <div class="space-y-4 text-gray-600">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>Jl. Pejanggik No. 70, Selong, Lombok Timur, NTB 83618</span>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>info@lomboktimurkab.go.id</span>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span>(0376) 21450</span>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
