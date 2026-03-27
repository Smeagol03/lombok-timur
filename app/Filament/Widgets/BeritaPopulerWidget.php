<?php

namespace App\Filament\Widgets;

use App\Models\Berita;
use Filament\Widgets\ChartWidget;

class BeritaPopulerWidget extends ChartWidget
{
    protected static ?int $sort = 4;

    protected ?string $heading = 'Berita Paling Banyak DiBaca';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $topBerita = Berita::where('status', 'published')
            ->orderByDesc('views')
            ->take(5)
            ->get();

        $labels = $topBerita->pluck('judul')->map(fn ($judul) => \Str::limit($judul, 30))->toArray();
        $data = $topBerita->pluck('views')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Views',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgba(54, 185, 117, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(249, 115, 22, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                        'rgba(236, 72, 153, 0.8)',
                    ],
                    'borderColor' => [
                        'rgb(54, 185, 117)',
                        'rgb(59, 130, 246)',
                        'rgb(249, 115, 22)',
                        'rgb(139, 92, 246)',
                        'rgb(236, 72, 153)',
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }
}
