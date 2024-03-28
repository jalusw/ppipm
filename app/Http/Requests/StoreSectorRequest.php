<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectorRequest extends FormRequest
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
            'code' => ['required','unique:sectors'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Mohon isi nama sektor',
            'code.required' => 'Mohon isi kode sektor',
            'code.unique' => 'Kode sektor tersebut sudahd di ambil'
        ];
    }
}
