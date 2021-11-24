<?php

namespace App\Models;

use App\Traits\AuthorObservable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
class BaseUserModel extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use AuthorObservable;


    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        public function scopeWithUser(\Illuminate\Database\Eloquent\Builder $query)
    {
        $table = $query->getModel()->getTable() . '.';

        $query
        ->leftJoin('users as create_user', function ($join) use ($table) {
            $join
            ->on($table . 'created_by', '=', 'create_user.id')
            ->whereNull('create_user.deleted_at');
        })
        ->leftJoin('users as update_user', function ($join) use ($table) {
            $join
            ->on($table . 'updated_by', '=', 'update_user.id')
            ->whereNull('update_user.deleted_at');
        });
        return $query;
    }

    public function scopeWithCondition(\Illuminate\Database\Eloquent\Builder $query, $condition)
    {
        $table = $query->getModel()->getTable() . '.';
        if ($condition->name) {
            if (in_array('name', $query->getModel()->getFillable())) {
                $query->where($table . 'name', 'LIKE', '%' . $condition->name . '%');
            }
        }
        if ($condition->contain_delete) {
            $query->withTrashed();
        }
        if ($condition->sort_type === 'name_asc') {
            $query->orderBy($table . 'name', 'asc');
        } elseif ($condition->sort_type === 'name_desc') {
            $query->orderBy($table . 'name', 'desc');
        } elseif ($condition->sort_type === 'displayorder_asc') {
            $query->orderBy($table . 'displayorder', 'asc');
        } elseif ($condition->sort_type === 'displayorder_desc') {
            $query->orderBy($table . 'displayorder', 'desc');
        } else {
            if (in_array('displayorder', $query->getModel()->getFillable())) {
                $query->orderBy($table . 'displayorder', 'asc');
            }
        }
        return $query;
    }

    public function scopeExceptSoftDeleteCateGoryAndSubCategory(\Illuminate\Database\Eloquent\Builder $query)
    {
        $query->leftJoin('categories', 'items.category_id', '=', 'categories.id')
        ->leftJoin('sub_categories', 'items.sub_category_id', '=', 'sub_categories.id')
        ->where(function ($query) {
            // 商品カテゴリが削除されていたら表示しない（商品カテゴリ設定がない商品を考慮して、idがnullは無視する）
            $query
            ->whereNull('categories.id')
            ->orWhereNull('categories.deleted_at');
        })
        ->where(function ($query) {
            // 商品サブカテゴリが削除されていたら表示しない（商品サブカテゴリ設定がない商品を考慮して、idがnullは無視する）
            $query
            ->whereNull('sub_categories.id')
            ->orWhereNull('sub_categories.deleted_at');
        });
        return $query;
    }
}
