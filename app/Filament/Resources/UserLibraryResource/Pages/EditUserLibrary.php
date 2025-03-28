<?php

namespace App\Filament\Resources\UserLibraryResource\Pages;

use App\Filament\Resources\UserLibraryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserLibrary extends EditRecord
{
    protected static string $resource = UserLibraryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
