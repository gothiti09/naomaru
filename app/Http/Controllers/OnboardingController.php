<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $family = Family::find(Auth::user()->company_id);
        return view('pages.onboarding.index', compact('family'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Family::finishOnboarding();
        return redirect('/')->with('success', '設定お疲れさまでした！まずは「＋追加」ボタンから面会交流を作りましょう。');
    }
}
