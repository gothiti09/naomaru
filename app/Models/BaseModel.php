<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\AuthorObservable;
use Illuminate\Support\Facades\Auth;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $blocked_user_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property User $user
 * @property User $user
 * @property User $user
 */
class BaseModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use AuthorObservable;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function scopeMine(\Illuminate\Database\Eloquent\Builder $query)
    {
        $table = $query->getModel()->getTable() . '.';
        return $query->where($table . 'created_by', Auth::id());
    }
}
