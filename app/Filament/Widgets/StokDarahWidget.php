<?php

namespace App\Filament\Widgets;

use App\Models\StokDarah;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StokDarahWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $golonganDarah = ['A', 'B', 'AB', 'O'];
        $stats = [];

        foreach ($golonganDarah as $golongan) {
            $stok = StokDarah::where('golongan', $golongan)->first();
            $jumlah = $stok?->jumlah ?? 0;

            $color = match (true) {
                $jumlah >= 50 => 'success',
                $jumlah >= 20 => 'warning',
                default => 'danger',
            };

            $stats[] = Stat::make("Golongan {$golongan}", $jumlah.' kantong')
                ->description($stok?->tanggal_update?->format('d M Y') ?? 'Belum diupdate')
                ->descriptionIcon('heroicon-m-heart')
                ->color($color);
        }

        return $stats;
    }
}
