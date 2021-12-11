<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReqestAuditForAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request_audit)
    {
        $this->request_audit = $request_audit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mail.request-audit-for-admin')
            ->subject('【' . config('app.name') . '】【管理者向け】新しい監査代行依頼が登録されました。')
            ->with(['request_audit' => $this->request_audit]);
    }
}
