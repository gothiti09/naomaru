<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property integer $id
 * @property integer $proposal_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $name
 * @property string $path
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Proposal $proposal
 */
class ProposalFile extends BaseModel
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
    protected $fillable = ['proposal_id', 'created_by', 'updated_by', 'name', 'path', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proposal()
    {
        return $this->belongsTo('App\Models\Proposal');
    }
}
