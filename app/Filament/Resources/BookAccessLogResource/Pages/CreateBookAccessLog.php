<?php

namespace App\Filament\Resources\BookAccessLogResource\Pages;

use App\Filament\Resources\BookAccessLogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBookAccessLog extends CreateRecord
{
    protected static string $resource = BookAccessLogResource::class;
}
