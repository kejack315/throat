<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRatingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // This will need to be changed to only allow logged in "admin" to use the update
       // return true;
        return !is_null(auth()->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        /*
         * id         * name         * stars         * icon
         */
        $ratingId = $this->route('rating');
        return [
            'name' => [
                'required',
                Rule::unique('ratings', 'name')->ignore($ratingId),
                'min:2',
                'max:32',
            ],
            'icon' => ['required', 'max:24',],
            'stars' => ['required', 'min:0', 'max:10',]
        ];
    }
}
