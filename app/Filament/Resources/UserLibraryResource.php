<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\UserLibrary;
use Filament\Resources\Resource;
use App\Filament\Resources\UserLibraryResource\Pages\EditUserLibrary;
use App\Filament\Resources\UserLibraryResource\Pages\CreateUserLibrary;
use App\Filament\Resources\UserLibraryResource\Pages\ListUserLibraries;

class UserLibraryResource extends Resource
{
    protected static ?string $model = UserLibrary::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Library Management';
    protected static ?string $navigationLabel = 'E-Book Access Logs';

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->whereHas('user', function($q) {
                $q->whereIn('role', ['student', 'teacher']);
            }))
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Reader')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'student' => 'info',
                        'teacher' => 'success',
                        default => 'secondary',
                    }),
                Tables\Columns\TextColumn::make('library.title')
                    ->label('E-Book')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_accessed_at')
                    ->label('Last Read')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->defaultSort('last_accessed_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'student' => 'Student',
                        'teacher' => 'Teacher'
                    ])
                    ->attribute('user.role'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Toggle::make('is_active')
                ->label('Access Status')
                ->helperText('Toggle access for this e-book')
                ->default(true),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUserLibraries::route('/'),
            'edit' => EditUserLibrary::route('/{record}/edit'),
        ];
    }
}
