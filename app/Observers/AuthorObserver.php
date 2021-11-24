<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class AuthorObserver
{
    public function creating(Model $model)
    {
        if (\Auth::check()) {
            $model->created_by = \Auth::user()->id;
            $model->updated_by = null;
            $model->updated_at = null;
            if (in_array('company_id', $model->getFillable())) {
                $model->company_id = \Auth::user()->company_id;
            }
            if (in_array('user_id', $model->getFillable())) {
                $model->user_id = \Auth::user()->id;
            }
        }
    }
    public function updating(Model $model)
    {
        if (\Auth::check()) {
            $model->updated_by = \Auth::user()->id;
            if (in_array('user_id', $model->getFillable())) {
                $model->user_id = \Auth::user()->id;
            }
        }
    }
    public function saving(Model $model)
    {
        if (\Auth::check()) {
            $model->updated_by = \Auth::user()->id;
            if (in_array('company_id', $model->getFillable())) {
                $model->company_id = \Auth::user()->company_id;
            }
            if (in_array('user_id', $model->getFillable())) {
                $model->user_id = \Auth::user()->id;
            }
        }
    }
    public function deleting(Model $model)
    {
        if (in_array('deleted_at', $model->getFillable())) {
            // 論理削除時は更新者を更新する（設定するだけではだめ）
            $model->fill(['updated_by', \Auth::user()->id])->save();
        }
    }

    public function restoring(Model $model)
    {
    }
}
