<?php

namespace App\Models;

class AuditRank extends \App\Models\generated\AuditRank
{
    public static function getByPointAvg($point_avg)
    {
        if ($point_avg >= 90) {
            return self::find(5);
        } elseif ($point_avg >= 70) {
            return self::find(4);
        } elseif ($point_avg >= 50) {
            return self::find(3);
        }
        return self::find(2);
    }
}
