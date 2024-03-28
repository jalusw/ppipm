<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserCreateRequest extends FormRequest
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
            "name" => ["required"],
            "username" => ["required", "unique:users"],
            "password" => ["required", "min:8", "confirmed"],
            "password_confirmation" => ["required"]
        ];
    }
    public function messages(): array
    {
        return [
            "name.required" => "Mohon Isi Nama Lengkap",
            "username.required" => "Mohon Isi Username",
            "password.required" => "Mohon Isi Password",
            "password.min" => "Mohon Buat Password Lebih Dari 8 Karakter",
            "password.confirmed" => "Mohon Pastikan Password Sama Dengan Konfirmasi Password"
        ];
    }
}
