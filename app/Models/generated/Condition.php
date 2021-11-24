<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property integer $id
 * @property integer $updated_by
 * @property string $type
 * @property string $description
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 */
class Condition extends BaseModel
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
    protected $fillable = ['updated_by', 'type', 'description', 'deleted_at', 'created_at', 'updated_at'];

}
