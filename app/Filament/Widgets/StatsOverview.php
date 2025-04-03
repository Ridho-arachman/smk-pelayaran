<?php

namespace App\Filament\Widgets;

use App\Models\PPDB;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;
    protected static ?string $maxHeight = '100px';
    protected static ?int $columns = 3;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Siswa', User::where('role', 'student')
                    ->where('is_active', true)
                    ->count())
                ->description('Total siswa aktif')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),

            Stat::make('Total Guru', User::where('role', 'teacher')
                    ->where('is_active', true)
                    ->count())
                ->description('Total guru aktif')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Pendaftar PPDB', PPDB::where('status', 'pending')->count())
                ->description('Menunggu persetujuan')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('warning'),
        ];
    }
}
