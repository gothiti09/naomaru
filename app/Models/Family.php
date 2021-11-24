<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Family extends \App\Models\generated\Family
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // newした時に自動的にuuidを設定する。
        $this->attributes['uuid'] = Str::uuid();
    }

    const PARENT_LABEL_DOUKYOOYA = 'DOUKYOOYA';
    const PARENT_LABEL_HAHAOYA = 'HAHAOYA';
    const PARENT_LABEL_TITIOYA = 'TITIOYA';

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function visitations()
    {
        return $this->hasMany('App\Models\Visitation');
    }

    public static function finishOnboarding()
    {
        self::find(Auth::user()->company_id)->fill(['finish_onboarding_at' => now()])->save();
    }

    public function parentLabelIsHahaoya()
    {
        return $this->parent_label === self::PARENT_LABEL_HAHAOYA;
    }

    public function parentLabelIsTitioya()
    {
        return $this->parent_label === self::PARENT_LABEL_TITIOYA;
    }
}
