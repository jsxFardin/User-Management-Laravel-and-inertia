<?php

namespace App\Http\Requests;

use App\Traits\ValidateMessage;
use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
        // dd($this->toArray());
        return [
            'agency_id'             => ['required'],
            'team_name'             => ['required'],
            'email'                 => ['required','email','max:255'],
            'mobile'                => ['required','numeric'],
            'contact_person'        => ['required'],
            'password'              => ($this->id || $this->user_id) ? '': ['required', 'min:8'],
            'assigns.*.camp_id'     => ['required'],
            'assigns.*.block_id'    => ['required'],
        ];
    }
}
