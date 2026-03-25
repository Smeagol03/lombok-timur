<x-layouts.app>
    <div class="min-h-screen bg-background py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="text-center mb-12">
                <h1 class="font-heading text-3xl md:text-4xl font-bold text-primary mb-4">
                    Pencarian
                </h1>
                <p class="text-gray-600">
                    Cari informasi dari seluruh konten website.
                </p>
            </div>
            
            {{-- Livewire Component --}}
            <livewire:pencarian />
        </div>
    </div>
</x-layouts.app>