<?php

namespace App\Filament\Widgets;

use App\Models\PPDB;
use Filament\Widgets\ChartWidget;

class PPDBStatusChart extends ChartWidget
{

    protected static ?int $sort = 3;
    protected static ?int $columns = 1;
    protected static ?string $heading = 'Statistik PPDB';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = [
            'pending' => PPDB::where('status', 'pending')->count(),
            'accepted' => PPDB::where('status', 'accepted')->count(),
            'rejected' => PPDB::where('status', 'rejected')->count(),
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Status PPDB',
                    'data' => array_values($data),
                    'backgroundColor' => ['#f59e0b', '#10b981', '#ef4444'],
                ],
            ],
            'labels' => ['Menunggu', 'Diterima', 'Ditolak'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
