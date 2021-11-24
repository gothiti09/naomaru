<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $uuid
 * @property string $parent_label
 * @property int $visitation_hour
 * @property int $visitation_period
 * @property int $message_times_a_day
 * @property boolean $no_mediation_condition
 * @property string $mediation_condition
 * @property string $desire_condition
 * @property string $set_visitation_at
 * @property string $set_resident_parent_at
 * @property string $set_resident_agent_at
 * @property string $inviting_non_resident_parent_at
 * @property string $set_non_resident_parent_at
 * @property string $set_non_resident_agent_at
 * @property string $set_child_at
 * @property string $finish_onboarding_at
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property InvitedFamily[] $invitedcompaniescompanies
 * @property Message[] $messagescompanies
 * @property User[] $userscompanies
 * @property Visitation[] $visitationscompanies
 */
class Family extends BaseModel
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
    protected $fillable = ['created_by', 'updated_by', 'uuid', 'parent_label', 'visitation_hour', 'visitation_period', 'message_times_a_day', 'no_mediation_condition', 'mediation_condition', 'desire_condition', 'set_visitation_at', 'set_resident_parent_at', 'set_resident_agent_at', 'inviting_non_resident_parent_at', 'set_non_resident_parent_at', 'set_non_resident_agent_at', 'set_child_at', 'finish_onboarding_at', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invitedcompaniescompanies()
    {
        return $this->hasMany('App\Models\InvitedFamily');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messagescompanies()
    {
        return $this->hasMany('App\Models\Message');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userscompanies()
    {
        return $this->hasMany('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visitationscompanies()
    {
        return $this->hasMany('App\Models\Visitation');
    }
}
