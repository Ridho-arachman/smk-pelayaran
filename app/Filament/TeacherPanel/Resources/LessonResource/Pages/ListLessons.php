<?php

namespace App\Filament\TeacherPanel\Resources\LessonResource\Pages;

use App\Filament\TeacherPanel\Resources\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLessons extends ListRecords
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    if (request()->has('course')) {
                        $data['course_id'] = request()->course;
                    }
                    return $data;
                }),
        ];
    }
}
