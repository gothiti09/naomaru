<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $uuid
 * @property string $checked_at
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property AuditItemGroupAnswer[] $auditItemGroupAnswersAudits
 */
class Audit extends BaseModel
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
    protected $fillable = ['created_by', 'updated_by', 'uuid', 'checked_at', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditItemGroupAnswersAudits()
    {
        return $this->hasMany('App\Models\AuditItemGroupAnswer');
    }
}