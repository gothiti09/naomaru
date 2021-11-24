<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class VisitationRequest extends FormRequest
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
            'possible_start_1_at' => ['required', 'date_format:Y-m-d H:i', 'before:possible_end_1_at'],
            'possible_start_2_at' => ['nullable', 'required_with:possible_end_2_at', 'date_format:Y-m-d H:i', 'before:possible_end_2_at'],
            'possible_start_3_at' => ['nullable', 'required_with:possible_end_3_at', 'date_format:Y-m-d H:i', 'before:possible_end_3_at'],
            'possible_end_1_at' => ['required_with:possible_start_1_at'],
            'possible_end_2_at' => ['required_with:possible_start_2_at'],
            'possible_end_3_at' => ['required_with:possible_start_3_at'],
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
            'possible_start_1_at.before' => '第一候補日時の開始時間を終了時間より前に設定してください。',
            'possible_start_2_at.before' => '第二候補日時の開始時間を終了時間より前に設定してください。',
            'possible_start_3_at.before' => '第三候補日時の開始時間を終了時間より前に設定してください。',
            'possible_start_1_at.required_with' => '第一候補日時の開始時間と終了時間の両方を入力してください。',
            'possible_start_2_at.required_with' => '第二候補日時の開始時間と終了時間の両方を入力してください。',
            'possible_start_3_at.required_with' => '第三候補日時の開始時間と終了時間の両方を入力してください。',
            'possible_end_1_at.required_with' => '第一候補日時の開始時間と終了時間の両方を入力してください。',
            'possible_end_2_at.required_with' => '第二候補日時の開始時間と終了時間の両方を入力してください。',
            'possible_end_3_at.required_with' => '第三候補日時の開始時間と終了時間の両方を入力してください。',
        ];
    }
}
