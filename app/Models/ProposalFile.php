<?php

namespace App\Models;

use Illuminate\Support\Str;

class ProposalFile extends \App\Models\generated\ProposalFile
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
}
