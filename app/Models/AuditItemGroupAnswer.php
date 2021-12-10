<?php

namespace App\Models;

class AuditItemGroupAnswer extends \App\Models\generated\AuditItemGroupAnswer
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditItemAnswers()
    {
        return $this->hasMany('App\Models\AuditItemAnswer');
    }
}
