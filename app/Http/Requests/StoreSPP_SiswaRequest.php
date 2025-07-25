<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class StoreSPP_SiswaRequest extends FormRequest
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
            "id_siswa" => ["required", "exists:database_biodata_siswa,id", "unique:spp_siswa,id_siswa"],
            "Nominal_SPP" => "required",
            "Potongan_SPP" => "required",
            "Bukti_Potongan"=>["mimetypes:application/pdf", "file","max:2048", "nullable"]
        ];
    }
}
