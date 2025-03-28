<?php

namespace App\Filament\Resources\BookLoanResource\Pages;

use App\Models\Library;
use App\Models\BookLoan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\BookLoanResource;

class CreateBookLoan extends CreateRecord
{
    protected static string $resource = BookLoanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = \App\Models\User::find($data['user_id']);
        
        if ($user->role === 'admin') {
            Notification::make()
                ->danger()
                ->title('Access Denied')
                ->body('Administrators cannot borrow books.')
                ->send();

            $this->halt();
        }

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            // Check if user is admin
            $user = \App\Models\User::find($data['user_id']);
            if ($user->role === 'admin') {
                Notification::make()
                    ->danger()
                    ->title('Cannot Borrow Book')
                    ->body('Administrators are not allowed to borrow books.')
                    ->send();

                $this->halt();
                return null;
            }

            $library = Library::find($data['library_id']);

            // Check if user has any active loans for this specific book
            $existingLoan = BookLoan::where('user_id', $data['user_id'])
                ->where('library_id', $data['library_id'])
                ->where('status', 'borrowed')
                ->first();

            if ($existingLoan) {
                Notification::make()
                    ->danger()
                    ->title('Cannot Borrow Same Book')
                    ->body('You already have an active loan for this specific book. Please return it first.')
                    ->send();

                $this->halt();
                return null;
            }

            // Check book stock
            if ($library->stock <= 0) {
                Notification::make()
                    ->danger()
                    ->title('Cannot Borrow Book')
                    ->body('This book is currently out of stock.')
                    ->send();

                $this->halt();
                return null;
            }

            $record = static::getModel()::create($data);
            $library->decrement('stock');

            Notification::make()
                ->success()
                ->title('Book Borrowed Successfully')
                ->body('The book has been borrowed and stock has been updated.')
                ->send();

            return $record;
        });
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return null; // This will disable the default "Created" notification
    }
}
