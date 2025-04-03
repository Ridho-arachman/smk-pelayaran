<?php

namespace App\Filament\Widgets;

use App\Models\PPDB;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPPDBApplications extends BaseWidget
{
    protected static ?int $sort = 2;
    protected static ?int $columns = 2;
    protected static ?string $heading = 'Pendaftaran PPDB Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(PPDB::latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('registration_number')
                    ->label('No. Pendaftaran'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'accepted',
                        'danger' => 'rejected',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Tanggal Daftar'),
            ]);
    }
}