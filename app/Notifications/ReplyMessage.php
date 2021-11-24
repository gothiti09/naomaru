<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyMessage extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.

     * @return void
     */
    public function __construct($message, $user)
    {
        $this->message = $message;
        $this->user_role = $user->roleLabel();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
            ->subject('【' . config('app.name', '') . '】' . $this->user_role . 'から返信が届きました。')
            ->greeting($this->user_role . 'から返信が届きました。')
            ->line($this->message->message)
            ->action('確認する', url(route('message.index')));
    }

    public function toArray($notifiable)
    {
        return [
            'text' => $this->user_role . 'から返信が届きました。',
            'url' => url(route('message.edit', $this->message->uuid)),
        ];
    }
}
