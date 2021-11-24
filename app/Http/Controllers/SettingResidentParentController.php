<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Family;
use App\Models\Prefecture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingResidentParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::getResidentParent();
        $prefectures = Prefecture::get();
        return view('pages.setting-resident-parent.create-edit', compact('user', 'prefectures'));
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
        Family::find(Auth::user()->company_id)->fill(['set_resident_parent_at' => now()])->save();
        return redirect('/')->with('success', '設定しました');
    }
}
