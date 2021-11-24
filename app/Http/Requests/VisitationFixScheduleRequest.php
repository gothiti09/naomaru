<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class VisitationFixScheduleRequest extends FormRequest
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
        $max_end_at = $this->visitation->hour
            ? Carbon::parse($this->scheduled_start_at)->addHours($this->visitation->hour)->format('Y-m-d H:i')
            : Carbon::parse($this->scheduled_end_at)->format('Y-m-d H:i');
        return [
            'scheduled_start_at' => [
                'required',
                'date_format:Y-m-d H:i',
                'before:scheduled_end_at',
                function ($attribute, $value, $fail) {
                    $scheduled_start_at = Carbon::parse($this->scheduled_start_at);
                    $scheduled_end_at = Carbon::parse($this->scheduled_end_at);
                    if (
                        ($this->visitation->possible_start_1_at && $this->visitation->possible_start_1_at->lte($scheduled_start_at) && $scheduled_end_at->lte($this->visitation->possible_end_1_at))
                        || ($this->visitation->possible_start_2_at && $this->visitation->possible_start_2_at->lte($scheduled_start_at) && $scheduled_end_at->lte($this->visitation->possible_end_2_at))
                        || ($this->visitation->possible_start_3_at && $this->visitation->possible_start_3_at->lte($scheduled_start_at) && $scheduled_end_at->lte($this->visitation->possible_end_3_at))
                    ) {
                        // FROM、TOが候補日時のいずれかに含まれていればOK
                    } else {
                        $fail('候補日時の範囲で指定してください');
                    }
                }
            ],
            'scheduled_end_at' => ['required', 'date_format:Y-m-d H:i', 'before_or_equal:' . $max_end_at],
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
            'scheduled_start_at.before' => '開始時間は終了時間より前の時間を入力してください。',
            'scheduled_end_at.before_or_equal' => '最大時間を超えない範囲で設定してください。',
            'possible_start_3_at.before' => '第三候補日時の時間（FROM-TO）を正しく入力してください。',
            'possible_start_1_at.required_with' => '第一候補日時はFROM-TOの両方を入力してください。',
            'possible_start_2_at.required_with' => '第二候補日時はFROM-TOの両方を入力してください。',
            'possible_start_3_at.required_with' => '第三候補日時はFROM-TOの両方を入力してください。',
            'possible_end_1_at.required_with' => '第一候補日時はFROM-TOの両方を入力してください。',
            'possible_end_2_at.required_with' => '第二候補日時はFROM-TOの両方を入力してください。',
            'possible_end_3_at.required_with' => '第三候補日時はFROM-TOの両方を入力してください。',
        ];
    }
}
