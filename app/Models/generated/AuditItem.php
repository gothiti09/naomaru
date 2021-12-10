<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property integer $id
 * @property integer $audit_item_group_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $title
 * @property int $point
 * @property boolean $checkbox
 * @property boolean $text
 * @property boolean $evidence
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property AuditItemGroup $auditItemGroup
 */
class AuditItem extends BaseModel
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
    protected $fillable = ['audit_item_group_id', 'created_by', 'updated_by', 'title', 'point', 'checkbox', 'text', 'evidence', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auditItemGroup()
    {
        return $this->belongsTo('App\Models\AuditItemGroup');
    }
}
