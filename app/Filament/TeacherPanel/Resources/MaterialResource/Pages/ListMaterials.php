<?php

namespace App\Filament\TeacherPanel\Resources\MaterialResource\Pages;

use App\Models\Lesson;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\TeacherPanel\Resources\MaterialResource;
use Illuminate\Contracts\Support\Htmlable;

class ListMaterials extends ListRecords
{
    protected static string $resource = MaterialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    if (request()->has('lesson')) {
                        $data['lesson_id'] = request()->lesson;
                    }
                    return $data;
                }),
        ];
    }

    public function getBreadcrumbs(): array
    {
        $lesson = request()->has('lesson') ? Lesson::find(request()->lesson) : null;
        $course = $lesson?->course;

        $crumbs = [
            route('filament.teacherPanel.resources.courses.index') => 'Courses',
        ];

        if ($course) {
            $crumbs[route('filament.teacherPanel.resources.lessons.index', ['course' => $course->id])] = $course->title;
        }

        if ($lesson) {
            $crumbs[route('filament.teacherPanel.resources.lessons.index', ['lesson' => $lesson->id])] = $lesson->title;
        }

        $crumbs[] = 'Materials';

        return $crumbs;
    }
}
