<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\ChartWidget;

class StudentsByGenderChart extends ChartWidget
{
    protected static ?int $sort = 3;
    protected static ?int $columns = 1;
    protected static ?string $heading = 'Statistik Siswa';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = [
            'male' => Student::whereHas('user', function ($q) {
                $q->where('gender', 'male');
            })->count(),
            'female' => Student::whereHas('user', function ($q) {
                $q->where('gender', 'female');
            })->count(),
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Jenis Kelamin',
                    'data' => array_values($data),
                    'backgroundColor' => ['#3b82f6', '#ec4899'],
                ],
            ],
            'labels' => ['Laki-laki', 'Perempuan'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
