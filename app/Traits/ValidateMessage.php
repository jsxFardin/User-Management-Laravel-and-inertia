<?php

namespace App\Traits;

trait ValidateMessage
{
    public function messages()
    {
        return [
            'required' => 'The :attribute field is required',
            'unique' => 'The :attribute field is must be unique',
            'email' => 'The :attribute field accept valid email address',
            'numeric' => 'The :attribute field accept  numeric value ',
            'min' => 'The :attribute minimum length will be :min',
            'max' => 'The :attribute maximum length will be :max',
            'assigns.*.camp_id.required' => 'The agency camp field is required',
            'assigns.*.block_id.required' => 'The agency blocks field is required',
            'row.*.agency_id.required' => 'The agency field is required',
            'row.*.team_id.required' => 'The agency blocks field is required',
            'same' => 'New password and confirm password is not matched',
            'different' => 'New password cannot be same as current password'
        ];
    }
}
