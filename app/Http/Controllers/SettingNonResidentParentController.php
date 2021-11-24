<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\InvitedFamily;
use App\Models\User;
use App\Notifications\OnboardNonResidentParent;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use PDF;

class SettingNonResidentParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::getNonResidentParent();
        return view('pages.setting-non-resident-parent.create-edit', compact('user'));
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
        $user->updateByRequest($request);
        return redirect('/')->with('success', '設定しました');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request->merge(['finish_onboarding_at' => now()]);
        Auth::user()->updateByRequest($request);
        Auth::user()->family->fill(['set_non_resident_parent_at' => now()])->save();
        Notification::send(User::getResidentRoleUsers(), new OnboardNonResidentParent());
        return redirect('/')->with('success', '設定しました');
    }
}
