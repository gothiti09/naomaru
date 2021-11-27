<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property string $code
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $region_id
 * @property string $name
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property User[] $usersPrefectures
 * @property Project[] $projectsDeliveryPrefectures
 */
class Prefecture extends BaseModel
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'code';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['created_by', 'updated_by', 'region_id', 'name', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usersPrefectures()
    {
        return $this->hasMany('App\Models\User', 'prefecture_code', 'code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectsDeliveryPrefectures()
    {
        return $this->hasMany('App\Models\Project', 'delivery_prefecture_code', 'code');
    }
}
