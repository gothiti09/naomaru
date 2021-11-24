<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class OnboardNonResidentParent extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.

     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $mail_message = new MailMessage();
        return ($mail_message)
            ->subject(Auth::user()->nonResidentParentLabel() . 'の初期設定が完了しました！')
            ->greeting('こんにちは！らえるです。')
            ->line(Auth::user()->nonResidentParentLabel() . 'がらえるにログインして初期設定が完了しました。')
            ->line('以下からログインして、初期設定を完了してください。')
            ->action('らえるを開く', url('/'))
            ->salutation('宜しくお願いします。');
    }
}
