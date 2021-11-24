<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StartVisitation extends Notification
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
            ->subject('面会交流が開始しました！')
            ->greeting('こんにちは!らえるです。')
            ->line('面会交流が開始しました。')
            ->line('開始時間：' . $this->visitation->start_at->isoFormat('M月D日(ddd) H:mm'))
            ->action('らえるを開く', url(route('visitation.edit', $this->visitation->uuid)))
            ->salutation('宜しくお願いします。');
    }
}
