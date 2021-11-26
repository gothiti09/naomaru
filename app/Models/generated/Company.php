<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $uuid
 * @property string $corporate_number
 * @property string $name
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Project[] $projectsCompanies
 * @property Proposal[] $proposalsCompanies
 * @property User[] $usersCompanies
 */
class Company extends BaseModel
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
    protected $fillable = ['created_by', 'updated_by', 'uuid', 'corporate_number', 'name', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectsCompanies()
    {
        return $this->hasMany('App\Models\Project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposalsCompanies()
    {
        return $this->hasMany('App\Models\Proposal');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usersCompanies()
    {
        return $this->hasMany('App\Models\User');
    }
}
