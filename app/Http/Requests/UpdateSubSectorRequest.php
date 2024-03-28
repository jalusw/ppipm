<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubSectorRequest extends FormRequest
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
            'sector_id' => 'required',
            'name' => ['required'],
            'code' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'sector_id.required' => 'Mohon pilih sektor',
            'name.required' => 'Mohon isi nama sub sektor',
            'code.required' => 'Mohon isi kode sub sektor',
        ];
    }
}
