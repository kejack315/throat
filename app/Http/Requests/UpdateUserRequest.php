<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('user');
        return [
            'name' => [
                'required',
                Rule::unique('users', 'name')->ignore($userId),
                'min:2',
                'max:32',

            ],
            'email' => ['required', 'max:24',],
            'password' => ['required', 'min:0', 'max:10',]
            ];
    }
}
