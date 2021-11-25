<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Project extends \App\Models\generated\Project
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // newした時に自動的にuuidを設定する。
        $this->attributes['uuid'] = Str::uuid();
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public static function mine()
    {
        return self::whereCreatedBy(Auth::id())->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stages()
    {
        return $this->hasMany('App\Models\ProjectStage');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function methods()
    {
        return $this->hasMany('App\Models\ProjectMethod');
    }
}
