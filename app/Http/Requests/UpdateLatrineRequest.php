<?php

namespace App\Http\Requests;

use App\Traits\ValidateMessage;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLatrineRequest extends FormRequest
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
            'block_id' => 'required|numeric',
            'facility_type_id' => 'required|numeric',
            'facility_used_id' => 'required|numeric',
            'construction_status_id' => 'required|numeric',
            'latrine_structure_id' => 'required|numeric',
            'pit_type_id' => 'required|numeric',
            'pwsn' => 'required',
            'constructor_id' => 'required|numeric',
            'sanitation_zone_id' => 'required|numeric',
            'chamber_door' => 'required|numeric',
            'male_number_stickers' => 'required|numeric',
            'male_number_user' => 'required|numeric',
            'female_number_stickers' => 'required|numeric',
            'female_number_user' => 'required|numeric',
            'children_number' => 'required|numeric',
            'common_shared' => 'required|numeric',
            'functional' => 'required|numeric',
            'non_functional' => 'required|numeric',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'total_chamber' => 'required|numeric',
            'total_ring_number' => 'required|numeric',
            'dia_of_ring' => 'required|numeric',
            'septic_tank_dimension' => 'required|numeric',
            'total_volume' => 'required|numeric',
        ];
    }
}
