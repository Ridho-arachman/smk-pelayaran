<?php

namespace App\Filament\Resources\BookLoanResource\Pages;

use App\Filament\Resources\BookLoanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditBookLoan extends EditRecord
{
    protected static string $resource = BookLoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (in_array($data['status'], ['returned', 'overdue'])) {
            Notification::make()
                ->danger()
                ->title('Access Denied')
                ->body('Cannot edit returned or overdue books.')
                ->send();

            $this->redirect($this->getResource()::getUrl('index'));
        }

        return $data;
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return null;
    }
}
