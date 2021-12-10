<?php

namespace App\Http\Controllers;

use App\Mail\ReqestAuditForAdmin;
use App\Models\RequestAudit;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RequestAuditController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.request-audit.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_audit = RequestAudit::create($request->all());
        Mail::to(config('domain.admin_mail'))->send(new ReqestAuditForAdmin($request_audit));
        return redirect('/')->with('success', '監査依頼を受け付けました。<br>3営業日以内に事務局から連絡させていただきますので、しばらくお待ち下さい。');
    }
}
