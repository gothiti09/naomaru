<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingVisitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $family = Family::find(Auth::user()->company_id);
        return view('pages.setting-visitation.create-edit', compact('family'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->no_mediation_condition) {
            $request->merge(['mediation_condition' => '']);
        }

        Family::find(Auth::user()->company_id)->fill($request->only([
            'parent_label',
            'visitation_period',
            'visitation_hour',
            'no_mediation_condition',
            'mediation_condition',
            'desire_condition'
        ]) + ['set_visitation_at' => now()])->save();
        return redirect('/')->with('success', '登録しました');
    }
}
