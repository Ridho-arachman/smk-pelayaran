<?php

namespace App\Filament\Widgets;

use App\Models\Library;
use App\Models\BookLoan;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LibraryStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 4;
    protected static ?string $maxHeight = '100px';
    protected static ?int $columns = 3;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Buku', Library::count())
                ->description('Jumlah koleksi buku')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('success'),
            
            Stat::make('Buku Tersedia', Library::where('stock', '>', 0)->count())
                ->description('Siap dipinjam')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('info'),
            
            Stat::make('Buku Digital', Library::whereNotNull('file_path')->count())
                ->description('Koleksi digital')
                ->descriptionIcon('heroicon-m-device-tablet')
                ->color('warning'),
        ];
    }
}