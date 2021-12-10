<?php

namespace App\Models;

use Illuminate\Support\Str;

class RequestAudit extends \App\Models\generated\RequestAudit
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }
}
