<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Proposal extends \App\Models\generated\Proposal
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
        'proposal_at',
        'delivery_at',
        'cancel_at',
    ];

    public static function mine()
    {
        return self::whereCreatedBy(Auth::id())->get();
    }

    public static function createByRequest($request)
    {
        $project = Project::whereUuid($request->project_uuid)->firstOrFail();

        $project = self::create($request->only([
            'description',
            'budget',
            'delivery_at',
        ]) + [
            'company_id' => Auth::user()->company_id,
            'project_id' => $project->id,
            'proposal_at' => now(),
        ]);
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

    public function getBudgetTextAttribute()
    {
        return number_format($this->budget) . '円';
    }
}
