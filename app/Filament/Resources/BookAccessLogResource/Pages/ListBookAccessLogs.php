<?php

namespace App\Filament\Resources\BookAccessLogResource\Pages;

use App\Filament\Resources\BookAccessLogResource;
use Filament\Resources\Pages\ListRecords;

class ListBookAccessLogs extends ListRecords
{
    protected static string $resource = BookAccessLogResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
