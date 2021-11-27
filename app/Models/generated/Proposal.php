<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property integer $id
 * @property integer $project_id
 * @property integer $company_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $uuid
 * @property string $description
 * @property string $proposal_at
 * @property string $delivery_at
 * @property string $request_meeting_at
 * @property string $cancel_at
 * @property string $cancel_reason
 * @property int $budget
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Project $project
 * @property Company $company
 * @property ProposalFile[] $proposalFilesProposals
 */
class Proposal extends BaseModel
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['project_id', 'company_id', 'created_by', 'updated_by', 'uuid', 'description', 'proposal_at', 'delivery_at', 'request_meeting_at', 'cancel_at', 'cancel_reason', 'budget', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposalFilesProposals()
    {
        return $this->hasMany('App\Models\ProposalFile');
    }
}
