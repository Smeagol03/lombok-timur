<x-layouts.app>
    <div class="min-h-screen bg-background py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="text-center mb-12">
                <h1 class="font-heading text-3xl md:text-4xl font-bold text-primary mb-4">
                    Layanan Publik
                </h1>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Akses berbagai layanan dan program dari Pemerintah Kabupaten Lombok Timur.
                </p>
            </div>
            
            {{-- Livewire Component --}}
            <livewire:layanan-list />
        </div>
    </div>
</x-layouts.app>