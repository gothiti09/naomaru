<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property integer $id
 * @property integer $audit_rank_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $uuid
 * @property int $point_sum
 * @property int $point_full
 * @property int $point_avg
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property AuditRank $auditRank
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
    protected $fillable = ['audit_rank_id', 'created_by', 'updated_by', 'uuid', 'point_sum', 'point_full', 'point_avg', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auditRank()
    {
        return $this->belongsTo('App\Models\AuditRank');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditItemGroupAnswersAudits()
    {
        return $this->hasMany('App\Models\AuditItemGroupAnswer');
    }
}
