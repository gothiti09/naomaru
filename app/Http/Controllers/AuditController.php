<?php

namespace App\Http\Controllers;

use App\Mail\CreateAuditForAdmin;
use App\Models\Audit;
use App\Models\AuditItemAnswer;
use App\Models\AuditItemGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latest_audit = Audit::mine()->latest()->first();
        return view('pages.audit.index', compact('latest_audit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $audit_item_groups = AuditItemGroup::with('auditItems')->get();
        return view('pages.audit.create', compact('audit_item_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $audit = Audit::createByRequest($request);
        Mail::to(config('domain.admin_mail'))->send(new CreateAuditForAdmin($audit));
        return redirect(route('audit.show', $audit->uuid))->with('success', '監査を登録しました。<br>内容確認などで事務局から連絡させていただく場合がございます。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function show(Audit $audit)
    {
        $audit->load(['auditItemGroupAnswers', 'auditItemGroupAnswers.auditItemAnswers',]);
        return view('pages.audit.show', compact('audit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function edit(Audit $audit)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Audit $audit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Audit $audit)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectFile  $projectFile
     * @return \Illuminate\Http\Response
     */
    public function download(AuditItemAnswer $auditItemAnswer)
    {
        return Storage::download($auditItemAnswer->evidence_path, $auditItemAnswer->evidence_name);
    }
}
