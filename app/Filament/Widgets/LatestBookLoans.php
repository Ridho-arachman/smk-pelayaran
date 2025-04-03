<?php

namespace App\Filament\Widgets;

use App\Models\BookLoan;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestBookLoans extends BaseWidget
{
    protected static ?int $sort = 5;
    protected static ?int $columns = 2;
    protected static ?string $heading = 'Peminjaman Buku Terbaru';
    protected static ?string $maxHeight = '300px';

    public function table(Table $table): Table
    {
        return $table
            ->query(BookLoan::with(['user', 'library'])->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Peminjam'),
                Tables\Columns\TextColumn::make('library.title')
                    ->label('Judul Buku'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'borrowed' => 'warning',
                        'returned' => 'success',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'borrowed' => 'Dipinjam',
                        'returned' => 'Dikembalikan',
                    }),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->label('Tenggat'),
            ]);
    }
}