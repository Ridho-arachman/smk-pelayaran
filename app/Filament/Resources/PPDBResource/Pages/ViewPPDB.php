<?php

namespace App\Filament\Resources\PPDBResource\Pages;

use Filament\Actions;
use Filament\Forms;
use App\Filament\Resources\PPDBResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use App\Notifications\PPDBAcceptedNotification;

class ViewPPDB extends ViewRecord
{
    protected static string $resource = PPDBResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('updateStatus')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->form([
                    Forms\Components\Select::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'accepted' => 'Accepted',
                            'rejected' => 'Rejected',
                        ])
                        ->required()
                        ->default($this->record->status),
                    Forms\Components\Textarea::make('notes')
                        ->default($this->record->notes),
                ])
                ->action(function (array $data) {
                    $oldStatus = $this->record->status;
                    $this->record->update($data);

                    if ($oldStatus !== 'accepted' && $data['status'] === 'accepted') {
                        $this->record->createStudentAccount();
                        $this->record->notify(new PPDBAcceptedNotification($this->record));
                        
                        Notification::make()
                            ->success()
                            ->title('PPDB application accepted')
                            ->body('Student account created and notification sent.')
                            ->send();
                    }
                }),
            Actions\Action::make('resendEmail')
                ->icon('heroicon-o-envelope')
                ->color('info')
                ->requiresConfirmation()
                ->visible(fn() => $this->record->status === 'accepted')
                ->action(function () {
                    $this->record->notify(new PPDBAcceptedNotification($this->record));
                    Notification::make()
                        ->success()
                        ->title('Email berhasil dikirim ulang')
                        ->send();
                }),
        ];
    }
}
