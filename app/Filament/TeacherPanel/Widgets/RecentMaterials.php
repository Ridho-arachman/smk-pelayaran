<?php

namespace App\Filament\TeacherPanel\Widgets;

use App\Models\Material;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class RecentMaterials extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Material::query()
                    ->whereHas('lesson.course', function($query) {
                        $query->where('teacher_id', Auth::user()->teacher->nip);
                    })
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lesson.title')
                    ->label('Lesson'),
                Tables\Columns\TextColumn::make('lesson.course.title')
                    ->label('Course'),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->colors([
                        'warning' => 'document',
                        'success' => 'video',
                        'info' => 'link',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->heading('Recent Learning Materials');
    }
}