<?php

namespace App\Filament\TeacherPanel\Resources\LessonResource\Pages;

use App\Filament\TeacherPanel\Resources\LessonResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLesson extends CreateRecord
{
    protected static string $resource = LessonResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (request()->has('course')) {
            $data['course_id'] = request()->course;
        }
        
        return $data;
    }
}
