<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Audit extends \App\Models\generated\Audit
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditItemGroupAnswers()
    {
        return $this->hasMany('App\Models\AuditItemGroupAnswer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditItemAnswers()
    {
        return $this->hasMany('App\Models\AuditItemAnswer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public static function createByRequest($request)
    {
        $audit = self::create();
        $audit_item_groups = AuditItemGroup::with('auditItems')->get();
        $audit_items = AuditItem::with('auditItemGroup')->get();

        foreach ((array)$request->audit_item_group_answers as $audit_item_group_id => $audit_item_group_answer_request) {
            $audit_item_group = $audit_item_groups->firstWhere('id', $audit_item_group_id);
            $audit_item_group_answer = $audit->auditItemGroupAnswers()->create([
                'title' => $audit_item_group->title,
            ]);
            foreach ($audit_item_group_answer_request['audit_item_answers'] as $audit_item_id => $audit_item_answer) {
                $answer_file =  $audit_item_answer['answer_file'] ?? null;
                $evidence_name = $answer_file?->getClientOriginalName();
                $evidence_path = $answer_file?->store('');
                $audit_item = $audit_items->firstWhere('id', $audit_item_id);
                // チェックかテキストに入力があればポイントを付与する
                $point =
                    (isset($audit_item_answer['answer_check']) && $audit_item_answer['answer_check']) ||
                    (isset($audit_item_answer['answer_text']) && $audit_item_answer['answer_text']) ? $audit_item->point : 0;
                $audit_item_group_answer->auditItemAnswers()->create([
                    'title' => $audit_item->title,
                    'checkbox' => $audit_item->checkbox,
                    'text' => $audit_item->text,
                    'evidence' => $audit_item->evidence,
                    'point' => $point,
                    'answer_text' => $audit_item_answer['answer_text'] ?? null,
                    'answer_check' => $audit_item_answer['answer_check'] ?? null,
                    'evidence_name' => $evidence_name,
                    'evidence_path' => $evidence_path,
                ]);
            }
        }

        $point_sum = DB::table('audit_item_answers')
            ->join('audit_item_group_answers', 'audit_item_answers.audit_item_group_answer_id', '=', 'audit_item_group_answers.id')
            ->where('audit_item_group_answers.audit_id', $audit->id)
            ->sum('point');

        $point_full = DB::table('audit_items')
            ->join('audit_item_groups', 'audit_items.audit_item_group_id', '=', 'audit_item_groups.id')
            ->sum('point');

        $point_avg = round(($point_sum / $point_full) * 100);

        // 監査ランクは内容関係なく自動でブロンズ。内容を確認して手動で変更
        $audit_rank = AuditRank::find(2);
        // $audit_rank = AuditRank::getByPointAvg($point_avg);

        $audit->fill([
            'point_sum' => $point_sum,
            'point_full' => $point_full,
            'point_avg' => $point_avg,
            'audit_rank_id' => $audit_rank->id,
        ])->save();

        // ユーザーには最新の監査レベルを設定
        Auth::user()->fill(['audit_rank_id' => $audit_rank->id])->save();

        return $audit;
    }
}
