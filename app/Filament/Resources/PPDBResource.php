<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\PPDB;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Forms\Components\ImageEntry;
use Forms\Components\ImageColumn;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use App\Notifications\PPDBAcceptedNotification;
use App\Filament\Resources\PPDBResource\Pages\EditPPDB;
use App\Filament\Resources\PPDBResource\Pages\ViewPPDB;
use App\Filament\Resources\PPDBResource\Pages\ListPPDBS;

class PPDBResource extends Resource
{
    protected static ?string $model = PPDB::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    // protected static ?string $navigationGroup = 'Admissions';
    protected static ?string $navigationLabel = 'PPDB Applications';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Student Information')->schema([
                Forms\Components\TextInput::make('name')->required()->disabled(),
                Forms\Components\TextInput::make('nisn')->required()->disabled(),
                Forms\Components\TextInput::make('email')->email()->required()->disabled(),
                Forms\Components\TextInput::make('phone')->tel()->required()->disabled(),
                Forms\Components\DatePicker::make('birth_date')->required()->disabled(),
                Forms\Components\TextInput::make('birth_place')->required()->disabled(),
                Forms\Components\Select::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])->required()->disabled(),
            ])->columns(2),

            Forms\Components\Section::make('School Information')->schema([
                Forms\Components\TextInput::make('previous_school')->required()->disabled(),
                Forms\Components\TextInput::make('parent_name')->required()->disabled(),
                Forms\Components\TextInput::make('parent_phone')->required()->disabled(),
                Forms\Components\Textarea::make('address')->required()->disabled(),
            ]),

            Forms\Components\Section::make('Documents')->schema([
                Forms\Components\Placeholder::make('documents')
                    ->content(function ($record) {
                        if (!$record || !$record->documents) {
                            return 'No documents uploaded';
                        }

                        $html = '<div class="flex flex-wrap gap-4">';
                        foreach ($record->documents as $doc) {
                            $url = asset('storage/' . $doc['path']);
                            $html .= '<img src="' . $url . '" class="w-20 h-20 object-cover">';
                        }
                        $html .= '</div>';

                        return new \Illuminate\Support\HtmlString($html);
                    }),
            ]),

            Forms\Components\Section::make('Application Status')->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                    ])->required(),
                Forms\Components\Textarea::make('notes')
                    ->placeholder('Add notes about this application'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('registration_number')
                    ->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nisn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'accepted',
                        'danger' => 'rejected',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('documents')
                    ->label('Foto Siswa')
                    ->circular()
                    ->stacked()
                    ->height(100)
                    ->getStateUsing(function ($record) {
                        if (!$record->documents) return [];
                        return collect($record->documents)->map(function ($doc) {
                            return asset('storage/' . $doc['path']);
                        })->toArray();
                    })
                    ->extraImgAttributes(['loading' => 'lazy'])
                    ->action(function ($record, $column) {
                        return Storage::download($record->documents[0]['path']);
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('resendEmail')
                    ->icon('heroicon-o-envelope')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn(PPDB $record) => $record->status === 'accepted')
                    ->action(function (PPDB $record) {
                        $record->notify(new PPDBAcceptedNotification($record));
                        Notification::make()
                            ->success()
                            ->title('Email berhasil dikirim ulang')
                            ->send();
                    }),
            ]);
    }

    protected static function acceptPPDB(PPDB $ppdb): void
    {
        $ppdb->update(['status' => 'accepted']);

        // Create student account and send notification
        $ppdb->createStudentAccount();
        $ppdb->notify(new PPDBAcceptedNotification($ppdb));
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPPDBS::route('/'),
            'view' => ViewPPDB::route('/{record}'),
        ];
    }
}
