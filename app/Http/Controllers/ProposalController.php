<?php

namespace App\Http\Controllers;

use App\Mail\CreatePrososal;
use App\Mail\CreatePrososalForAdmin;
use App\Mail\ReqestMeetingForAdmin;
use App\Models\Project;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $project = Project::whereUuid($request->project_uuid)->firstOrFail();
        $proposal = new Proposal();
        return view('pages.proposal.create-edit', compact('project', 'proposal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proposal = Proposal::createByRequest($request);
        // ユーザーメールアドレスとユーザーの通知メールアドレスに送信
        Mail::to([$proposal->project->createdBy->email] + $proposal->project->createdBy->user_emails->pluck('email')->toArray())->send(new CreatePrososal($proposal));
        Mail::to(config('domain.admin_mail'))->send(new CreatePrososalForAdmin($proposal));
        return redirect('/')->with('success', '提案を登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function show(Proposal $proposal)
    {
        $project = $proposal->project;
        return view('pages.proposal.show', compact('project', 'proposal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposal $proposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proposal $proposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function requestMeeting(Request $request, Proposal $proposal)
    {
        $proposal->requestMeeting($request);
        Mail::to(config('domain.admin_mail'))->send(new ReqestMeetingForAdmin($proposal));
        return redirect(route('proposal.show', $proposal->uuid))->with('success', 'Web面談を受け付けました。<br>3営業日以内に事務局から連絡させていただきますので、しばらくお待ち下さい。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposal $proposal)
    {
        //
    }
}
