<?php

namespace App\Filament\TeacherPanel\Resources\MaterialResource\Pages;

use App\Filament\TeacherPanel\Resources\MaterialResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMaterial extends CreateRecord
{
    protected static string $resource = MaterialResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (request()->has('lesson')) {
            $data['lesson_id'] = request()->lesson;
        }
        
        return $data;
    }
}
