<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKemitraanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'umkm_id' => 'required|exists:umkms,id',
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'partnership_form' => 'required|string',
            'description' => 'nullable|string',
            'start_of_partnership' => 'required|string',
            'end_of_partnership' => 'required|string',
            'partnership_status' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Kolom :attribute harus diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'exists' => 'Data :attribute tidak valid.',
        ];
    }

    public function attributes()
    {
        return [
            'umkm_id' => 'UMKM',
            'perusahaan_id' => 'Perusahaan',
            'partnership_form' => 'Formasi Kemitraan',
            'description' => 'Deskripsi',
            'start_of_partnership' => 'Mulai Kemitraan',
            'end_of_partnership' => 'Akhir Kemitraan',
            'partnership_status' => 'Status Kemitraan',
        ];
    }
}
