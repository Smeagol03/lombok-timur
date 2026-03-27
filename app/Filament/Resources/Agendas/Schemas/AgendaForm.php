<?php

namespace App\Filament\Resources\Agendas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AgendaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Agenda')
                    ->schema([
                        TextInput::make('judul')
                            ->label('Judul Kegiatan')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Rapat Koordinasi Pembangunan')
                            ->columnSpanFull(),
                        Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->placeholder('Deskripsi singkat kegiatan')
                            ->columnSpanFull(),
                        Select::make('jenis')
                            ->label('Jenis Agenda')
                            ->required()
                            ->options([
                                'bupati' => 'Bupati',
                                'wabup' => 'Wakil Bupati',
                                'sekda' => 'Sekretaris Daerah',
                            ])
                            ->default('bupati')
                            ->columnSpanFull(),
                        TextInput::make('lokasi')
                            ->label('Lokasi')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Ruang Rapat Kantor Bupati')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make('Waktu')
                    ->schema([
                        DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->columnSpanFull(),
                        TimePicker::make('jam_mulai')
                            ->label('Jam Mulai')
                            ->required()
                            ->format('H:i')
                            ->columnSpanFull(),
                        TimePicker::make('jam_selesai')
                            ->label('Jam Selesai')
                            ->format('H:i')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }
}
