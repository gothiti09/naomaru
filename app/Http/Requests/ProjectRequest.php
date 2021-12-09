<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:40'],
            'budget_undecided' => ['required_without_all:min_budget,max_budget'],
            'min_budget' => ['nullable', 'exclude_if:max_budget,null', 'lte:max_budget'],
            'desired_delivery_at' => ['required', 'date_format:Y-m-d', 'after:close_at'],
            'close_at' => ['required', 'date_format:Y-m-d', 'after:today'],
            'file.*' => ['max:10000']
        ];
    }

    /**
     * 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'budget_undecided.required_without_all' => '希望上限予算、希望下限予算がわからない場合は、予算未定をチェックしてください。',
            'desired_delivery_at.after' => '希望納期は、提案期限より後の日付を指定してください。',
            'close_at.after' => '提案期限は、本日より後の日付を指定してください。',
            'file.*.max' => '添付ファイルは、1ファイル10MBまでにしてください。',
            'min_budget.lte' => '希望下限予算は、希望上限予算より小さくなければなりません。',
        ];
    }

    public function attributes()
    {
        return [
            'title' => '募集タイトル',
            'desired_delivery_at' => '希望納期',
            'close_at' => '提案期限',
        ];
    }
}
