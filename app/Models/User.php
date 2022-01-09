<?php

namespace App\Models;

use Illuminate\Support\Str;

class User extends \App\Models\generated\User
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // newした時に自動的にuuidを設定する。
        $this->attributes['uuid'] = Str::uuid();
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public static function getByCorporateNumberAndId($corporate_number, $login_id) {
        $company = Company::whereCorporateNumber($corporate_number)->first();
        return self::whereCompanyId($company->id)->whereLoginId($login_id)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_emails()
    {
        return $this->hasMany('App\Models\UserEmail');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function audits()
    {
        return $this->hasMany('App\Models\Audit');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function latestAudit()
    {
        return $this->hasOne('App\Models\Audit')->orderBy('id', 'desc');
    }


}
