<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CraetePesertaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "nama" => "required",
            "nis" => "required|unique:pesertas,nis",
            "email" => "required|email|unique:pesertas,email",
            "kelas" => "required",
        ];
    }

    protected $dontValidateCsrf = true;
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => 'Validasi gagal',
            'errors' => $validator->errors(),
        ], 422));
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Kolom nama wajib diisi.',
            'nis.required' => 'Kolom NIS wajib diisi.',
            'nis.unique' => 'NIS sudah digunakan.',
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'kelas.required' => 'Kolom kelas wajib diisi.',
        ];
    }
}