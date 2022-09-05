<?php

namespace App\Http\Requests;

use App\Traits\ValidateMessage;
use Illuminate\Foundation\Http\FormRequest;


class StoreUserRequest extends FormRequest
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
            'name'              => 'required|max:50',
            'username'          => 'required|unique:users',
            'email'             => 'required|email|unique:users',
            'mobile'            => 'required|numeric|unique:users',
            'password'          => 'required|min:8',
            'roles'             => 'required',
            // 'row.*.agency_id'   => 'required',
            // 'row.*.team_id'     => 'required',
        ];
    }
}
