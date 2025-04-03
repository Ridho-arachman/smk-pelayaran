<?php

namespace App\Filament\Resources\PPDBResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\PPDBResource;
use Filament\Notifications\Notification;
use App\Notifications\PPDBAcceptedNotification;

class EditPPDB extends EditRecord
{
    protected static string $resource = PPDBResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('resendEmail')
                ->icon('heroicon-o-envelope')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn() => $this->record->status === 'accepted')
                ->action(function () {
                    $this->record->notify(new PPDBAcceptedNotification($this->record));
                    Notification::make()
                        ->success()
                        ->title('Email berhasil dikirim ulang')
                        ->send();
                }),
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        // If status changed to accepted
        if ($this->record->wasChanged('status') && $this->record->status === 'accepted') {
            $this->record->createStudentAccount();
            $this->record->notify(new PPDBAcceptedNotification($this->record));
            
            Notification::make()
                ->success()
                ->title('PPDB application accepted')
                ->body('Student account created and notification sent.')
                ->send();
        }
    }
}
