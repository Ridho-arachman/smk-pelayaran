<?php

namespace App\Filament\TeacherPanel\Widgets;

use App\Models\Lesson;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class UnpublishedLessons extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Lesson::query()
                    ->whereHas('course', function($query) {
                        $query->where('teacher_id', Auth::user()->teacher->nip);
                    })
                    ->where('is_published', false)
                    ->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('course.title')
                    ->label('Course'),
                Tables\Columns\TextColumn::make('materials_count')
                    ->counts('materials')
                    ->label('Materials'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->heading('Unpublished Lessons');
    }
}