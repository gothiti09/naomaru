<?php

namespace App\Models;

use Illuminate\Support\Str;

class Company extends \App\Models\generated\Company
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // newした時に自動的にuuidを設定する。
        $this->attributes['uuid'] = Str::uuid();
    }
}
