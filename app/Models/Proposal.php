<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;

class Proposal extends \App\Models\generated\Proposal
{
    public static function mine()
    {
        return self::whereCreatedBy(Auth::id())->get();
    }
}
