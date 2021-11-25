<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property integer $id
 * @property integer $project_id
 * @property integer $method_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Project $project
 * @property Method $method
 */
class ProjectMethod extends BaseModel
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
    protected $fillable = ['project_id', 'method_id', 'created_by', 'updated_by', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function method()
    {
        return $this->belongsTo('App\Models\Method');
    }
}
