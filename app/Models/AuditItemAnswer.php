<?php

namespace App\Models;

use Illuminate\Support\Str;

class AuditItemAnswer extends \App\Models\generated\AuditItemAnswer
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditItemAnswers()
    {
        return $this->hasMany('App\Models\AuditItemAnswer');
    }
}
