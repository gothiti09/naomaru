<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property integer $id
 * @property integer $company_id
 * @property integer $user_id
 * @property string $delivery_prefecture_code
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $uuid
 * @property string $title
 * @property string $description
 * @property string $status
 * @property string $open_at
 * @property string $close_at
 * @property string $desired_delivery_at
 * @property string $cancel_at
 * @property string $cancel_reason
 * @property int $min_budget
 * @property int $max_budget
 * @property boolean $budget_undecided
 * @property boolean $open
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Company $company
 * @property User $user
 * @property Prefecture $deliveryPrefecture
 * @property Proposal[] $proposalsProjects
 * @property ProjectFile[] $projectFilesProjects
 * @property ProjectStage[] $projectStagesProjects
 * @property ProjectMethod[] $projectMethodsProjects
 */
class Project extends BaseModel
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
    protected $fillable = ['company_id', 'user_id', 'delivery_prefecture_code', 'created_by', 'updated_by', 'uuid', 'title', 'description', 'status', 'open_at', 'close_at', 'desired_delivery_at', 'cancel_at', 'cancel_reason', 'min_budget', 'max_budget', 'budget_undecided', 'open', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deliveryPrefecture()
    {
        return $this->belongsTo('App\Models\Prefecture', 'delivery_prefecture_code', 'code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposalsProjects()
    {
        return $this->hasMany('App\Models\Proposal');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectFilesProjects()
    {
        return $this->hasMany('App\Models\ProjectFile');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectStagesProjects()
    {
        return $this->hasMany('App\Models\ProjectStage');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectMethodsProjects()
    {
        return $this->hasMany('App\Models\ProjectMethod');
    }
}
