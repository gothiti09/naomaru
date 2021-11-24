<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitationFixScheduleRequest;
use App\Http\Requests\VisitationRequest;
use App\Models\Family;
use App\Models\Visitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VisitationController extends Controller
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
    public function create()
    {
        $visitation = new Visitation();
        $family = Family::find(Auth::user()->company_id);
        $visitation->hour = $family->visitation_hour;
        $visitation->mediation_condition = $family->mediation_condition;
        $visitation->desire_condition = $family->desire_condition;
        return view('pages.visitation.create-edit', compact('visitation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitationRequest $request)
    {
        Visitation::createByRequest($request);
        return redirect('/')->with('success', '登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visitation  $visitation
     * @return \Illuminate\Http\Response
     */
    public function show(Visitation $visitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visitation  $visitation
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitation $visitation)
    {
        return view('pages.visitation.create-edit', compact('visitation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitation  $visitation
     * @return \Illuminate\Http\Response
     */
    public function update(VisitationRequest $request, Visitation $visitation)
    {
        $visitation->fill($request->all())->save();
        return redirect('/')->with('success', '更新しました');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitation  $visitation
     * @return \Illuminate\Http\Response
     */
    public function fixSchedule(VisitationFixScheduleRequest $request, Visitation $visitation)
    {
        $visitation->fixSchedule($request);
        return redirect('/')->with('success', '更新しました');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitation  $visitation
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request, Visitation $visitation)
    {
        $visitation->cancel(Auth::user()->nonResidentParentLabel() . 'の予定が合わなかったため、キャンセルしました。');
        return redirect('/')->with('success', '更新しました');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitation  $visitation
     * @return \Illuminate\Http\Response
     */
    public function start(Request $request, Visitation $visitation)
    {
        $visitation->start();
        return redirect(route('visitation.edit', $visitation->uuid))->with('success', '面会交流を開始しました。解散したらすぐに終了をしてください。');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitation  $visitation
     * @return \Illuminate\Http\Response
     */
    public function end(Request $request, Visitation $visitation)
    {
        $visitation->end();
        return redirect(route('visitation.edit', $visitation->uuid))->with('success', '面会交流を終了しました。完了報告をしてください。');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitation  $visitation
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request, Visitation $visitation)
    {
        $visitation->report($request);
        return redirect('/')->with('success', '完了報告しました。お疲れさまでした。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visitation  $visitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitation $visitation)
    {
        try {
            $visitation->forcedelete();
            return redirect('/')->with('success', '削除しました');
        } catch (Exception $e) {
            return redirect('/')->withErrors('関連するデータが存在するため、削除できません');
        }
    }
}
