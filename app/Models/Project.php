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

    protected $dates = [
        'open_at',
        'close_at',
        'desired_delivery_at',
        'cancel_at',
    ];

    public static function mine()
    {
        return self::whereCreatedBy(Auth::id())->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposals()
    {
        return $this->hasMany('App\Models\Proposal');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stages()
    {
        return $this->belongsToMany('App\Models\Stage', 'project_stages');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function methods()
    {
        return $this->belongsToMany('App\Models\Method', 'project_methods');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deliveryPrefecture()
    {
        return $this->belongsTo('App\Models\Prefecture', 'delivery_prefecture_code', 'code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public static function createByRequest($request)
    {
        $project = self::create($request->all() + [
            'company_id' => Auth::user()->company_id,
            'status' => 'start',
            'open_at' => now(),
        ]);

        $project->stages()->attach($request->stages);
        $project->methods()->attach($request->methods);
    }

    public function getBudgetAttribute()
    {
        if ($this->budget_undecided) {
            return '未定';
        } elseif ($this->min_budget && $this->max_budget) {
            return number_format($this->min_budget) . '円〜' . number_format($this->max_budget) . '円';
        } elseif ($this->min_budget) {
            return number_format($this->min_budget) . '円〜';
        } elseif ($this->min_budget) {
            return '〜' . number_format($this->max_budget) . '円';
        }
    }
}
