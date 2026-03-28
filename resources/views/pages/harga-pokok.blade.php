<x-layouts.app
    :title="$title ?? null"
    :description="$description ?? null"
    :keywords="$keywords ?? null"
    :ogImage="$ogImage ?? null">

    <div class="bg-gray-50 min-h-screen">
        {{-- Hero Section - Swiss Modern Design --}}
        <section class="bg-primary py-20 md:py-28 relative overflow-hidden">
            {{-- Abstract Geometric Pattern --}}
            <div class="absolute inset-0 opacity-5">
                <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-white rounded-full blur-2xl transform -translate-x-1/3 translate-y-1/3"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-end">
                    {{-- Main Content - Left Side --}}
                    <div class="lg:col-span-8">
                        {{-- Breadcrumb Style Label --}}
                        <div class="flex items-center gap-3 mb-6">
                            <div class="h-px w-8 bg-white/40"></div>
                            <span class="text-xs font-medium tracking-[0.2em] text-white uppercase">Data Publik</span>
                        </div>

                        {{-- Title - Bold Typography --}}
                        <h1 class="font-sans text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold !text-white tracking-tight leading-[0.95]">
                            Harga Bahan<br>
                            <span class="text-white font-light">Pokok</span>
                        </h1>

                        {{-- Description --}}
                        <p class="text-white mt-6 text-base md:text-lg max-w-2xl leading-relaxed">
                            Informasi terkini dan transparan harga kebutuhan pokok di pasar Kabupaten Lombok Timur
                        </p>

                        {{-- Metadata --}}
                        @if($lastUpdate)
                        <div class="flex items-center gap-4 mt-8">
                            <div class="flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-xs font-medium text-white/90">Terakhir diperbarui</span>
                            </div>
                            <span class="text-sm text-white/60 font-mono">{{ $lastUpdate->format('d M Y') }}</span>
                        </div>
                        @endif
                    </div>

                    {{-- Action Panel - Right Side --}}
                    <div class="lg:col-span-4">
                        <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xs font-medium tracking-widest text-white/60 uppercase">Quick Stats</span>
                                <svg class="w-5 h-5 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>

                            <div class="grid grid-cols-3 gap-3">
                                <div class="text-center">
                                    <span class="block text-2xl font-bold text-white">{{ $prices->count() }}</span>
                                    <span class="text-[10px] uppercase tracking-wide text-white/50">Total</span>
                                </div>
                                @php
                                    $naik = $prices->filter(fn($p) => isset($p->change['type']) && $p->change['type'] === 'up')->count();
                                    $turun = $prices->filter(fn($p) => isset($p->change['type']) && $p->change['type'] === 'down')->count();
                                @endphp
                                <div class="text-center border-l border-white/20">
                                    <span class="block text-2xl font-bold text-red-400">{{ $naik }}</span>
                                    <span class="text-[10px] uppercase tracking-wide text-white/50">Naik</span>
                                </div>
                                <div class="text-center border-l border-white/20">
                                    <span class="block text-2xl font-bold text-green-400">{{ $turun }}</span>
                                    <span class="text-[10px] uppercase tracking-wide text-white/50">Turun</span>
                                </div>
                            </div>
                        </div>

                        {{-- Back Button --}}
                        <a href="{{ url('/') }}" class="group flex items-center justify-center gap-3 mt-4 w-full px-6 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 rounded-xl transition-all duration-300">
                            <svg class="w-5 h-5 text-white/70 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            <span class="text-sm font-medium text-white/80 group-hover:text-white">Kembali ke Beranda</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Content Section --}}
        <section class="py-12 md:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if($prices->count() > 0)
                {{-- Table Grid - Swiss Style --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-16">No</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Komoditi</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-24">Satuan</th>
                                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider w-32">Harga (Rp)</th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-32">Perubahan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($prices as $index => $price)
                                @php
                                    $previous = \App\Models\HargaPokok::where('nama_komoditi', $price->nama_komoditi)
                                        ->where('tanggal_update', '<', $price->tanggal_update)
                                        ->latest('tanggal_update')
                                        ->first();

                                    $change = null;
                                    if ($previous) {
                                        $diff = $price->harga - $previous->harga;
                                        $change = $diff > 0 ? ['type' => 'up', 'value' => $diff] :
                                                  ($diff < 0 ? ['type' => 'down', 'value' => abs($diff)] : ['type' => 'same', 'value' => 0]);
                                    }
                                @endphp
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-gray-400 font-mono">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4">
                                        <span class="font-medium text-gray-900">{{ $price->nama_komoditi }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $price->satuan }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="font-bold text-gray-900 text-sm tabular-nums">
                                            {{ number_format($price->harga, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($change && $change['type'] === 'up')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-semibold bg-red-50 text-red-600">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                                                </svg>
                                                +{{ number_format($change['value'], 0, ',', '.') }}
                                            </span>
                                        @elseif($change && $change['type'] === 'down')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-semibold bg-green-50 text-green-600">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                                </svg>
                                                -{{ number_format($change['value'], 0, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-xs">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Info Card --}}
                <div class="mt-8 bg-gray-900 rounded-xl p-6 md:p-8">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="text-white/80">
                            <h3 class="font-semibold text-white mb-2">Catatan Informasi</h3>
                            <p class="text-sm leading-relaxed">
                                Harga yang ditampilkan merupakan harga terkini di pasar Kabupaten Lombok Timur.
                                Perubahan harga menunjukkan selisih dari harga sebelumnya.
                                Data diperbarui secara berkala oleh admin Dinas Perdagangan.
                            </p>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center py-20 bg-white rounded-xl border border-gray-100">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">Data harga belum tersedia</p>
                    <p class="text-gray-400 text-sm mt-1">Silakan hubungi admin untuk input data</p>
                </div>
                @endif
            </div>
        </section>
    </div>
</x-layouts.app>
