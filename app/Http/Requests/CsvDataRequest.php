<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsvDataRequest extends FormRequest
{
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
            'category' => 'required',
            'file' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category.required' => 'Category field is required',
            'file.required' => 'File field is required',
        ];
    }
}
