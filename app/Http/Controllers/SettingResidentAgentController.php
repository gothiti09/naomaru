<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SettingResidentAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::getResidentAgent();
        return view('pages.setting-resident-agent.create-edit', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        User::createByRequest($request, User::ROLE_RESIDENT_AGENT);
        return redirect('/')->with('success', '設定しました');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if (!$user->finish_onboarding_at) {
            $request->merge(['finish_onboarding_at' => now()]);
        }
        $user->updateByRequest($request);
        return redirect('/')->with('success', '設定しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect('/')->with('success', '削除しました');
        } catch (Exception $e) {
            return redirect('/')->withErrors('削除できませんでした。お問い合わせください。');
        }
    }
}
