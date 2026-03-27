<?php

namespace App\Filament\Widgets;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Layanan;
use App\Models\Pengumuman;
use App\Models\Wisata;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KontenOverviewWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Berita', Berita::count())
                ->description(Berita::where('status', 'published')->count().' dipublikasi')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5]),
            Stat::make('Total Pengumuman', Pengumuman::count())
                ->description(Pengumuman::where('is_penting', true)->count().' penting')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color('warning'),
            Stat::make('Total Wisata', Wisata::count())
                ->description('Destinasi wisata')
                ->descriptionIcon('heroicon-m-photo')
                ->color('success'),
            Stat::make('Total Layanan', Layanan::count())
                ->description(Layanan::where('is_active', true)->count().' aktif')
                ->descriptionIcon('heroicon-m-building-library')
                ->color('info'),
            Stat::make('Agenda Mendatang', Agenda::whereDate('tanggal', '>=', today())->count())
                ->description('Kegiatan terjadwal')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('gray'),
        ];
    }
}
