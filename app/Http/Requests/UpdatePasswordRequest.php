<?php

namespace App\Http\Requests;

use App\Traits\ValidateMessage;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    use ValidateMessage;
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'different:current_password'],
            'confirm_password' => ['required', 'min:8', 'same:new_password'],
        ];
    }
}
