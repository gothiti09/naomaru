<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ToBeScheduleVisitation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.

     * @return void
     */
    public function __construct($visitation)
    {
        $this->visitation = $visitation;
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
            ->subject('新しい面会交流が登録されました！')
            ->greeting('こんにちは!らえるです。')
            ->line(Auth::user()->residentParentLabel() . 'が新しい面会交流を登録しました。')
            ->line('以下から日程を決めてください。')
            ->action('らえるを開く', url(route('visitation.edit', $this->visitation->uuid)))
            ->salutation('宜しくお願いします。');
    }
}
