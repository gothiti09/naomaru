<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property integer $id
 * @property integer $audit_item_group_answer_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $uuid
 * @property string $title
 * @property boolean $checkbox
 * @property boolean $text
 * @property boolean $evidence
 * @property string $answer_text
 * @property boolean $answer_check
 * @property int $point
 * @property string $evidence_name
 * @property string $evidence_path
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property AuditItemGroupAnswer $auditItemGroupAnswer
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
    protected $fillable = ['audit_item_group_answer_id', 'created_by', 'updated_by', 'uuid', 'title', 'checkbox', 'text', 'evidence', 'answer_text', 'answer_check', 'point', 'evidence_name', 'evidence_path', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auditItemGroupAnswer()
    {
        return $this->belongsTo('App\Models\AuditItemGroupAnswer');
    }
}
