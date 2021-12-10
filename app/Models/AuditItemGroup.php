<?php

namespace App\Models;

class AuditItemGroup extends \App\Models\generated\AuditItemGroup
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditItems()
    {
        return $this->hasMany('App\Models\AuditItem');
    }
}
