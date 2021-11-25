<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $uuid
 * @property string $status
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property AuditItemAnswer[] $auditItemAnswersUserAudits
 */
class UserAudit extends BaseModel
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
    protected $fillable = ['created_by', 'updated_by', 'uuid', 'status', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditItemAnswersUserAudits()
    {
        return $this->hasMany('App\Models\AuditItemAnswer');
    }
}
