<?php

namespace App\Filament\Widgets;

use App\Models\Library;
use App\Models\BookLoan;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PopularBooksChart extends ChartWidget
{
    protected static ?int $sort = 6;
    protected static ?int $columns = 2;
    protected static ?string $heading = 'Buku Terpopuler';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $popularBooks = Library::withCount('loans')
            ->orderByDesc('loans_count')
            ->limit(5)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Peminjaman',
                    'data' => $popularBooks->pluck('loans_count')->toArray(),
                    'backgroundColor' => ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
                ],
            ],
            'labels' => $popularBooks->pluck('title')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}