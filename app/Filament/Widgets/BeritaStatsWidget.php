<?php

namespace App\Filament\Widgets;

use App\Models\Berita;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BeritaStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $published = Berita::where('status', 'published')->count();
        $draft = Berita::where('status', 'draft')->count();
        $thisMonth = Berita::where('status', 'published')
            ->whereMonth('published_at', now()->month)
            ->whereYear('published_at', now()->year)
            ->count();

        return [
            Stat::make('Berita Dipublikasi', $published)
                ->description('Total berita yang telah dipublikasi')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success'),
            Stat::make('Draft', $draft)
                ->description('Berita yang belum dipublikasi')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning'),
            Stat::make('Diterbitkan Bulan Ini', $thisMonth)
                ->description(' berita baru bulan ini')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),
        ];
    }
}
