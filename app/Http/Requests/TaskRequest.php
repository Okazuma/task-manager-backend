<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'detail' =>'required|string|max:255',
            'deadline' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ];
    }



    public function messages(): array
    {
        return [
            'name.required' => 'タスク名を入力してください',
            'name.string' => '文字列で入力してください',
            'name.max' => '255文字以内で入力してください',

            'detail.required' => 'タスク内容を入力してください',
            'detail.string' => '文字列で入力してください',
            'detail.max' => '255文字以内で入力してください',

            'deadline.required' => '日程を選択してください',
            'deadline.date' => '正しい日付を入力してください',

            'user_id.required' => 'ユーザー認証が必要です',
            'user_id.exists' => 'ユーザーIDが存在しません',
        ];
    }
}
