<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendScheduleFixList extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.

     * @return void
     */
    public function __construct($companies)
    {
        $this->companies = $companies;
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
            ->subject('【' . config('app.name', '') . '】日程調整メール送信先一覧')
            ->greeting('日程調整メールを送信しました。')
            ->line('以下の家族に送信しました。続けて送られている場合は迷惑メールに入っていないか連絡をするなどの対応をしてください。')
            ->line($this->companies->pluck('users.*.email'));
    }
}
