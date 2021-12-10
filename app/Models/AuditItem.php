<?php

namespace App\Models;

class AuditItem extends \App\Models\generated\AuditItem
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auditItemGroup()
    {
        return $this->belongsTo('App\Models\AuditItemGroup');
    }
}
