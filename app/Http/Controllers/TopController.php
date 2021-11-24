<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Visitation;
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
        if (!Auth::user()->family->finish_onboarding_at && Auth::user()->isResidentRole()) {
            return redirect('/onboarding');
        }

        if (!Auth::user()->finish_onboarding_at) {
            if (Auth::user()->isResidentParent()) {
                return redirect('/setting-resident-parent');
            } elseif (Auth::user()->isResidentAgent()) {
                return redirect('/setting-resident-agent');
            } elseif (Auth::user()->isNonResidentParent()) {
                return redirect('/setting-non-resident-parent');
            } elseif (Auth::user()->isNonResidentAgent()) {
                return redirect('/setting-non-resident-agent');
            } elseif (Auth::user()->isChild()) {
                return redirect('/setting-child');
            }
        }
        $latest_visitation = Visitation::latest();
        $visitations = Visitation::list();
        return view('pages.top.index', compact('latest_visitation', 'visitations'));
    }
}
