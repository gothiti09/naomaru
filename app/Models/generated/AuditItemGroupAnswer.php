<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property integer $id
 * @property integer $audit_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $title
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Audit $audit
 * @property AuditItemAnswer[] $auditItemAnswersAuditItemGroupAnswers
 */
class AuditItemGroupAnswer extends BaseModel
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
    protected $fillable = ['audit_id', 'created_by', 'updated_by', 'title', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function audit()
    {
        return $this->belongsTo('App\Models\Audit');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditItemAnswersAuditItemGroupAnswers()
    {
        return $this->hasMany('App\Models\AuditItemAnswer');
    }
}
