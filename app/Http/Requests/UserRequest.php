<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
        if (!$this->user) {
            $this->user = Auth::id();
        }
        return [
            'company.corporate_number' => ['required', 'integer', 'digits_between:13,15'],
            'login_id' => ['required', 'string', 'min:6', 'max:255', Rule::unique('users')->whereNull('deleted_at')->ignore($this->user)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->whereNull('deleted_at')->ignore($this->user)],
            'password' => ['nullable', 'confirmed', Password::defaults()],
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
            'email.unique' => 'すでに利用されているメールアドレスのため利用できません。',
        ];
    }

    public function attributes()
    {
        return [
            'company.corporate_number' => '法人番号',
            'login_id' => 'ログインID',
        ];
    }
}
