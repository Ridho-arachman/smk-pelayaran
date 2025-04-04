<?php

namespace App\Filament\TeacherPanel\Resources\CourseResource\Pages;

use App\Filament\TeacherPanel\Resources\CourseResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();
        if ($user && $user->teacher) {
            $data['teacher_id'] = $user->teacher->nip;
        } else {
            // If there's no teacher associated with the user, you might want to handle this case
            // For example, redirect back with an error message
            // This is just a placeholder - you'll need to implement proper error handling
            throw new \Exception('You must be a teacher to create a course.');
        }
        
        return $data;
    }
}
