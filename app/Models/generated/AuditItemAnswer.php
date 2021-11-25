<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property integer $id
 * @property integer $user_audit_id
 * @property integer $audit_item_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $title
 * @property int $point
 * @property string $path
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property UserAudit $userAudit
 * @property AuditItem $auditItem
 */
class AuditItemAnswer extends BaseModel
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
    protected $fillable = ['user_audit_id', 'audit_item_id', 'created_by', 'updated_by', 'title', 'point', 'path', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userAudit()
    {
        return $this->belongsTo('App\Models\UserAudit');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auditItem()
    {
        return $this->belongsTo('App\Models\AuditItem');
    }
}
