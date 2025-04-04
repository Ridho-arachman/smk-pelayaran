<?php

namespace App\Filament\TeacherPanel\Widgets;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Material;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $teacher = Auth::user()->teacher;

        return [
            Stat::make('Total Courses', Course::where('teacher_id', $teacher->nip)->count())
                ->description('Your active courses')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),
            
            Stat::make('Total Lessons', Lesson::whereHas('course', function($query) use ($teacher) {
                $query->where('teacher_id', $teacher->nip);
            })->count())
                ->description('Across all courses')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('warning'),
            
            Stat::make('Learning Materials', Material::whereHas('lesson.course', function($query) use ($teacher) {
                $query->where('teacher_id', $teacher->nip);
            })->count())
                ->description('Total learning materials')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
        ];
    }
}