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
        'desired_1_meeting_at',
        'desired_2_meeting_at',
        'desired_3_meeting_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposalFiles()
    {
        return $this->hasMany('App\Models\ProposalFile');
    }

    public static function mine()
    {
        return self::whereCreatedBy(Auth::id())->orderBy('created_at', 'desc')->get();
    }

    public static function createByRequest($request)
    {
        $project = Project::whereUuid($request->project_uuid)->firstOrFail();

        $proposal = self::create($request->only([
            'description',
            'budget',
            'delivery_at',
        ]) + [
            'company_id' => Auth::user()->company_id,
            'project_id' => $project->id,
            'proposal_at' => now(),
        ]);

        $files = $request->file('file');
        foreach ((array)$files as $file) {
            $path = $file->store('');
            $proposal->proposalFiles()->create([
                'name' => $file->getClientOriginalName(),
                'path' => $path,
            ]);
        }

        return $proposal;
    }

    public function requestMeeting($request)
    {
        $this->fill([
            'request_meeting_at' => now(),
            'desired_1_meeting_at' => $request->desired_1_meeting_at,
            'desired_2_meeting_at' => $request->desired_2_meeting_at,
            'desired_3_meeting_at' => $request->desired_3_meeting_at,
        ])->save();
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
