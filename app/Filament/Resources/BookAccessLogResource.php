<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookAccessLogResource\Pages;
use App\Filament\Resources\BookAccessLogResource\RelationManagers;
use App\Models\BookAccessLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookAccessLogResource extends Resource
{
    protected static ?string $model = BookAccessLog::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Library Management';
    protected static ?string $navigationLabel = 'Access Logs';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('library.title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('accessed_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('action'),
                Tables\Columns\TextColumn::make('ip_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_agent')
                    ->searchable(),
            ])
            ->filters([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookAccessLogs::route('/'),
        ];
    }
}
