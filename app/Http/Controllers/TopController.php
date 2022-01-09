<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->finish_onboarding_at) {
            return redirect(route('user.edit', Auth::user()->uuid));
        }
        $projects = Project::mine();
        $proposals = Proposal::mine();
        if (!Auth::user()->audits->count()) {
            session()->flash('success', '監査登録が完了していません。');
        }
        return view('pages.top.index', compact('projects', 'proposals'));
    }
}
