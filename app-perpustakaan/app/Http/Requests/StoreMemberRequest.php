<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:100',
            'email' => 'required|unique:members,email',
            'nomor_telepon' => 'required|string|min:11',
            'alamat' => 'required|string',
            'status' => 'required|string|in:Aktif,Tidak Aktif'
        ];
    }
    public function messages(): array {
        return [
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Batas jumlah karakter = 100'
        ];
    }
}
//{{-- 'nama', 'nim', 'email', 'nomor_telepon', 'alamat', 'status' --}}//