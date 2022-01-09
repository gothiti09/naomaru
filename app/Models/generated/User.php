<?php

namespace App\Models\generated;

use App\Models\BaseUserModel;

/**
 * @property integer $id
 * @property string $prefecture_code
 * @property integer $company_id
 * @property integer $audit_rank_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $uuid
 * @property boolean $is_admin
 * @property string $email
 * @property string $login_id
 * @property string $name
 * @property string $team_name
 * @property string $kana
 * @property string $age_range
 * @property string $tel
 * @property string $sex
 * @property string $email_verified_at
 * @property string $finish_onboarding_at
 * @property string $description
 * @property string $url
 * @property boolean $is_buyer
 * @property string $password
 * @property string $remember_token
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Company $company
 * @property AuditRank $auditRank
 * @property Prefecture $prefecture
 * @property Project[] $projectsUsers
 * @property Proposal[] $proposalsUsers
 * @property UserEmail[] $userEmailsUsers
 * @property Audit[] $auditsUsers
 * @property RequestAudit[] $requestAuditsUsers
 */
class User extends BaseUserModel
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
    protected $fillable = ['prefecture_code', 'company_id', 'audit_rank_id', 'created_by', 'updated_by', 'uuid', 'is_admin', 'email', 'login_id', 'name', 'team_name', 'kana', 'age_range', 'tel', 'sex', 'email_verified_at', 'finish_onboarding_at', 'description', 'url', 'is_buyer', 'password', 'remember_token', 'deleted_at', 'created_at', 'updated_at'];

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
    public function auditRank()
    {
        return $this->belongsTo('App\Models\AuditRank');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prefecture()
    {
        return $this->belongsTo('App\Models\Prefecture', 'prefecture_code', 'code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectsUsers()
    {
        return $this->hasMany('App\Models\Project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposalsUsers()
    {
        return $this->hasMany('App\Models\Proposal');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userEmailsUsers()
    {
        return $this->hasMany('App\Models\UserEmail');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditsUsers()
    {
        return $this->hasMany('App\Models\Audit');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requestAuditsUsers()
    {
        return $this->hasMany('App\Models\RequestAudit');
    }
}
