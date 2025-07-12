<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSPP_SiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // "id_siswa" => ["required", "exists:database_biodata_siswa,id", "unique:spp_siswa,id_siswa"],
            "Nominal_SPP" => "required",
            "Potongan_SPP" => "required",
            "bukti_potongan"=>["mimetypes:application/pdf", "max:2048", "nullable"],
            'file_name' => ['nullable', 'string', 'max:255', 'unique:spp_siswa,bukti_potongan'],
        ];
    }
}
