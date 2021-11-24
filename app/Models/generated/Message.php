<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property integer $id
 * @property integer $company_id
 * @property integer $message_by
 * @property integer $reply_by
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $uuid
 * @property string $message
 * @property string $reply
 * @property int $displayorder
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Family $family
 * @property User $messageBy
 * @property User $replyBy
 */
class Message extends BaseModel
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
    protected $fillable = ['company_id', 'message_by', 'reply_by', 'created_by', 'updated_by', 'uuid', 'message', 'reply', 'displayorder', 'deleted_at', 'created_at', 'updated_at'];

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
    public function messageBy()
    {
        return $this->belongsTo('App\Models\User', 'message_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function replyBy()
    {
        return $this->belongsTo('App\Models\User', 'reply_by');
    }
}
