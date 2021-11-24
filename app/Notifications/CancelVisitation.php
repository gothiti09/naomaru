<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CancelVisitation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.

     * @return void
     */
    public function __construct($visitation, $cancel_reason)
    {
        $this->visitation = $visitation;
        $this->cancel_reason = $cancel_reason;
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
            ->subject('面会交流がキャンセルされました。')
            ->greeting('面会交流がキャンセルされました。')
            ->line('こんにちは。らえるです。')
            ->line('面会交流がキャンセルされました。')
            ->line('キャンセル理由：' . $this->cancel_reason)
            ->action('らえるを開く', url(route('visitation.edit', $this->visitation->uuid)))
            ->line('別日程で新しく面会交流を登録してください。')
            ->salutation('宜しくお願いします。');
    }
}
