<?php

namespace App\Filament\Widgets;

use App\Models\Agenda;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class AgendaHariIniWidget extends TableWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected function getTableHeading(): ?string
    {
        return 'Agenda Hari Ini';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Agenda::query()
                    ->whereDate('tanggal', today())
                    ->orderBy('jam_mulai')
            )
            ->columns([
                TextColumn::make('judul')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('jenis')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'bupati' => 'Bupati',
                        'wabup' => 'Wakil Bupati',
                        'sekda' => 'Sekretaris Daerah',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'bupati' => 'primary',
                        'wabup' => 'success',
                        'sekda' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('lokasi')
                    ->limit(30),
                TextColumn::make('jam_mulai')
                    ->time('H:i')
                    ->label('Mulai'),
                TextColumn::make('jam_selesai')
                    ->time('H:i')
                    ->label('Selesai')
                    ->default('-'),
            ])
            ->emptyStateHeading('Tidak ada agenda hari ini')
            ->emptyStateDescription('Tidak ada kegiatan yang terjadwal untuk hari ini.')
            ->emptyStateIcon('heroicon-o-calendar');
    }
}
