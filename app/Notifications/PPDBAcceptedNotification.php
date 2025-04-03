<?php

namespace App\Notifications;

use App\Models\PPDB;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PPDBAcceptedNotification extends Notification
{
    use Queueable;

    public function __construct(protected PPDB $ppdb)
    {
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage)
            ->subject('Selamat! Pendaftaran PPDB Anda Diterima')
            ->greeting('Halo ' . $this->ppdb->name)
            ->line('Selamat! Anda telah diterima di SMK Pelayaran.')
            ->line('Berikut adalah informasi penting untuk Anda:')
            ->line('NIS: ' . $this->ppdb->student->nis)
            ->line('Email: ' . $this->ppdb->student->user->email)
            ->line('Password: password')
            ->line('Silakan login ke sistem dengan email dan password di atas.')
            ->action('Login Sekarang', url('/login'))
            ->line('Harap segera ubah password Anda setelah login pertama kali.');
    }
}