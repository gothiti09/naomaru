<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateAuditForAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($audit)
    {
        $this->audit = $audit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mail.create-audit-for-admin')
            ->subject('【' . config('app.name') . '】【管理者向け】新しい監査依頼が登録されました。')
            ->with(['audit' => $this->audit]);
    }
}
