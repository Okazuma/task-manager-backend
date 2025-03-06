<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::id(),
            'password' => 'nullable|string|min:8',
        ];
    }

    public function messages(): array
    {
        return[
            'name.required' => '名前を入力してください',
            'name.string' => '文字列で入力してください',
            'name.max' => '255文字以内で入力してください',

            'email.required' => 'メールアドレスを入力してください',
            'email.string' => '有効なメールアドレスを入力してください',
            'email.email' => 'メール形式で入力してください',
            'email.unique' => 'このメールアドレスはすでに使われてます',

            'password.string' => '文字列で入力してください',
            'password.min' => '8文字以上で設定してください',
        ];
    }
}
