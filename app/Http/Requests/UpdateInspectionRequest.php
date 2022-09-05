<?php

namespace App\Http\Requests;

use App\Traits\ValidateMessage;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInspectionRequest extends FormRequest
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
            'latrine_id' => 'required|exists:latrines,id',
            'count_filled_up_ring' => 'required|numeric',
            'available_height_from_top' => 'required|numeric',
            'remarks' => 'nullable'
        ];
    }
}
