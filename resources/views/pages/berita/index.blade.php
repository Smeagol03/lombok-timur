<x-layouts.app 
    :title="$title ?? null"
    :description="$description ?? null"
    :keywords="$keywords ?? null"
    :ogImage="$ogImage ?? null">
    <div class="min-h-screen bg-gray-50 py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="text-center mb-10 sm:mb-14">
                <h1 class="font-heading text-2xl sm:text-3xl md:text-4xl font-bold text-primary mb-3 sm:mb-4">
                    Berita & Informasi
                </h1>
                <p class="text-gray-600 max-w-2xl mx-auto text-sm sm:text-base">
                    Informasi terbaru seputar kegiatan pembangunan dan pelayanan pemerintah Kabupaten Lombok Timur.
                </p>
            </div>
            
            {{-- Livewire Component --}}
            <livewire:berita-list />
        </div>
    </div>
</x-layouts.app>
