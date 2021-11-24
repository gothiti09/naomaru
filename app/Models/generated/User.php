<?php

namespace App\Models\generated;

use App\Models\BaseUserModel;

/**
 * @property integer $id
 * @property integer $company_id
 * @property string $prefecture_code
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $uuid
 * @property string $email
 * @property string $role
 * @property string $name
 * @property string $kana
 * @property string $age_range
 * @property string $tel
 * @property string $sex
 * @property string $email_verified_at
 * @property string $password
 * @property boolean $alert_schedule
 * @property boolean $alert_action
 * @property boolean $alert_report
 * @property boolean $alert_message
 * @property boolean $read_report
 * @property boolean $read_message
 * @property string $finish_onboarding_at
 * @property string $remember_token
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Family $family
 * @property Prefecture $prefecture
 * @property Message[] $messagesMessageBies
 * @property Message[] $messagesReplyBies
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
    protected $fillable = ['company_id', 'prefecture_code', 'created_by', 'updated_by', 'uuid', 'email', 'role', 'name', 'kana', 'age_range', 'tel', 'sex', 'email_verified_at', 'password', 'alert_schedule', 'alert_action', 'alert_report', 'alert_message', 'read_report', 'read_message', 'finish_onboarding_at', 'remember_token', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function family()
    {
        return $this->belongsTo('App\Models\Family');
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
    public function messagesMessageBies()
    {
        return $this->hasMany('App\Models\Message', 'message_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messagesReplyBies()
    {
        return $this->hasMany('App\Models\Message', 'reply_by');
    }
}
