<?php

namespace App\Notifications;

use Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerification extends Notification
{
    use Queueable;

    public $message,$subject,$otp;
    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->message = __('messages_trans.verification_process');
        $this->subject = __('messages_trans.verification_needed');
        $this->otp = new Otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $otp = $this->otp->generate($notifiable->email,6,60);
        return (new MailMessage)
            ->mailer('smtp')
            ->subject($this->subject)
            ->greeting(__('messages_trans.hello').' '.$notifiable->name)
            ->line($this->message)
            ->line(__('messages_trans.code').' : '.$otp->token);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
