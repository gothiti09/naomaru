<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CreateUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.

     * @return void
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
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
            ->subject('らえるへ招待されました！')
            ->greeting('ようこそ、らえるへ！')
            -> line('らえるは面会交流の調整が簡単にできる面会交流支援サービスです。')
            ->line('同居親（お子様と同居する親）かららえるへ招待されました。')
            ->line('以下からログインしてください。')
            ->action('らえるを開く', url(route('login', ['email' => $this->user->email])))
            ->line('初期パスワード：' . $this->password)
            ->salutation('宜しくお願いします。');
    }
}
