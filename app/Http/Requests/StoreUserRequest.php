<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255', // 例如，要求 'name' 字段是字符串，且不超过255个字符
            'password' => 'required|string|max:255',
            'email' => 'required|email|unique:users', // 例如，要求 'email' 字段是有效的电子邮件且在 'users' 表中唯一
            // 其他字段的验证规则...
        ];
    }
}
