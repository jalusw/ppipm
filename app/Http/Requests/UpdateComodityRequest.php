<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateComodityRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'sub_sector_id' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Mohon isi nama',
            'sub_sector_id.required' => 'Mohon pilih sub sektor'
        ];
    }
}