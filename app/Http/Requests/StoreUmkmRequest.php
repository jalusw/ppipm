<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUmkmRequest extends FormRequest
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
            'nib' => ['required', 'unique:umkms,nib'],
            'business_name' => ['required'],
            'email' => ['required', 'email'],
            'phone_number' => ['required'],
            'kbli' => ['required', 'size:5'],
            'address' => ['required'],
            'capital' => ['required', 'numeric'],
            'personal_data.name' => ['required'],
            'personal_data.nik' => ['nullable', 'unique:personal_data,nik'],
            'personal_data.place_of_birth' => ['nullable'],
            'personal_data.date_of_birth' => ['nullable', 'date'],
            'personal_data.gender' => ['nullable', 'in:male,female'],
            'personal_data.address' => ['nullable'],
            'personal_data.phone_number' => ['nullable'],
            'personal_data.email' => ['nullable', 'email'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'unique' => 'Data :attribute sudah ada.',
            'email' => 'Format :attribute tidak valid.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'size' => 'Kolom :attribute harus memiliki panjang :size karakter.',
            'date' => 'Format :attribute tidak valid.',
            'in' => 'Pilihan :attribute tidak valid.',
        ];
    }

    public function attributes()
    {
        return [
            'nib' => 'NIB',
            'business_name' => 'Nama Usaha',
            'email' => 'Email',
            'phone_number' => 'Nomor Telepon',
            'kbli' => 'KBLI',
            'address' => 'Alamat',
            'capital' => 'Modal',
            'personal_data.name' => 'Nama',
            'personal_data.nik' => 'NIK',
            'personal_data.place_of_birth' => 'Tempat Lahir',
            'personal_data.date_of_birth' => 'Tanggal Lahir',
            'personal_data.gender' => 'Jenis Kelamin',
            'personal_data.address' => 'Alamat',
            'personal_data.phone_number' => 'Nomor Telepon',
            'personal_data.email' => 'Email Personal',
        ];
    }

}
