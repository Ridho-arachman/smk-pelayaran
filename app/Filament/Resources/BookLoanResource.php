<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\BookLoan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\BookLoanResource\Pages\EditBookLoan;
use App\Filament\Resources\BookLoanResource\Pages\ListBookLoans;
use App\Filament\Resources\BookLoanResource\Pages\CreateBookLoan;

class BookLoanResource extends Resource
{
    protected static ?string $model = BookLoan::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Library Management';
    protected static ?string $navigationLabel = 'Physical Book Loans';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->relationship(
                    'user',
                    'name',
                    fn ($query) => $query->whereNot('role', 'admin')
                )
                ->searchable()
                ->preload()
                ->required(),
            Forms\Components\Select::make('library_id')
                ->relationship('library', 'title')
                ->searchable()
                ->preload()
                ->required(),
            Forms\Components\DateTimePicker::make('borrowed_at')
                ->required()
                ->default(now()),
            Forms\Components\DateTimePicker::make('due_date')
                ->required()
                ->default(now()->addDays(7)),
            Forms\Components\DateTimePicker::make('returned_at')
                ->nullable(),
            Forms\Components\Select::make('status')
                ->options([
                    'borrowed' => 'Borrowed',
                    'returned' => 'Returned',
                    'overdue' => 'Overdue'
                ])
                ->default('borrowed')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('user.name')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('library.title')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('borrowed_at')
                ->dateTime()
                ->sortable(),
            Tables\Columns\TextColumn::make('due_date')
                ->dateTime()
                ->sortable(),
            Tables\Columns\TextColumn::make('returned_at')
                ->dateTime()
                ->sortable(),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->state(function (BookLoan $record): string {
                    if ($record->returned_at) {
                        if ($record->returned_at > $record->due_date) {
                            $record->update(['status' => 'overdue']);
                            return 'overdue';
                        }
                        return 'returned';
                    }

                    if ($record->due_date->isPast()) {
                        $record->update(['status' => 'overdue']);
                        return 'overdue';
                    }

                    return $record->status;
                })
                ->color(fn(string $state): string => match ($state) {
                    'borrowed' => 'warning',
                    'returned' => 'success',
                    'overdue' => 'danger',
                    default => 'secondary',
                }),
        ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'borrowed' => 'Borrowed',
                        'returned' => 'Returned',
                        'overdue' => 'Overdue'
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('return')
                    ->action(function (BookLoan $record) {
                        if (!$record->returned_at) {
                            DB::transaction(function () use ($record) {
                                $record->update([
                                    'returned_at' => now(),
                                    'status' => 'returned'
                                ]);
                                $record->library()->increment('stock');
                            });

                            Notification::make()
                                ->success()
                                ->title('Book Returned Successfully')
                                ->body('The book has been returned and stock has been updated.')
                                ->send();
                        }
                    })
                    ->requiresConfirmation()
                    ->visible(fn(BookLoan $record) => $record->status === 'borrowed')
                    ->color('success')
                    ->icon('heroicon-o-check'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBookLoans::route('/'),
            'create' => CreateBookLoan::route('/create'),
            'edit' => EditBookLoan::route('/{record}/edit'),
        ];
    }
}
