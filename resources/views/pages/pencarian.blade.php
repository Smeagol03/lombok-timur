<x-layouts.app 
    title="Pencarian - Kabupaten Lombok Timur"
    description="Cari informasi berita, pengumuman, layanan publik, dan destinasi wisata di Kabupaten Lombok Timur."
    keywords="pencarian, cari, berita, layanan, wisata, lombok timur">
    <div class="min-h-screen bg-gray-50 py-10 sm:py-14">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="text-center mb-10 sm:mb-14">
                <h1 class="font-heading text-2xl sm:text-3xl md:text-4xl font-bold text-primary mb-3 sm:mb-4">
                    Pencarian
                </h1>
                <p class="text-gray-600 text-sm sm:text-base">
                    Cari informasi dari seluruh konten website.
                </p>
            </div>
            
            {{-- Livewire Component --}}
            <livewire:pencarian />
        </div>
    </div>
</x-layouts.app>