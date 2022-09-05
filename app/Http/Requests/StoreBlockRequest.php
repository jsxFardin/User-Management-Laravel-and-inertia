<?php

namespace App\Http\Requests;

use App\Traits\ValidateMessage;
use Illuminate\Foundation\Http\FormRequest;

class StoreBlockRequest extends FormRequest
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
            'camp_id' => 'required|numeric',
            'name' => 'required',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'area' => 'required|numeric',
            'number_of_family' => 'required|numeric',
            'number_of_house' => 'required|numeric',
            'population' => 'required|numeric',
            'short_name' => 'required'
        ];
    }
}
