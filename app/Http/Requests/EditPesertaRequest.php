<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditPesertaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "nama" => "required",
            "nis" => "required|unique:pesertas,nis,".$this->route("id"),
            "email" => "required|email|unique:pesertas,email,".$this->route("id"),
            "kelas" => "required",
        ];
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

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => 'Validasi gagal',
            'errors' => $validator->errors(),
        ], 422));
    }
}