<?php

namespace App\Filament\Resources\BookAccessLogResource\Pages;

use App\Filament\Resources\BookAccessLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookAccessLog extends EditRecord
{
    protected static string $resource = BookAccessLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
