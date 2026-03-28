<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminPasswordResetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected string $otp
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Reset Password Admin - Portal Lombok Timur')
            ->greeting('Halo '.$notifiable->name.',')
            ->line('Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.')
            ->line('Kode OTP Anda adalah:')
            ->line("**{$this->otp}**")
            ->line('Kode ini berlaku selama 15 menit.')
            ->line('Jika Anda tidak merasa melakukan permintaan ini, Anda dapat mengabaikan email ini.')
            ->salutation('Salam,')
            ->salutation('Tim Admin Portal Lombok Timur');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'otp' => $this->otp,
        ];
    }
}
