<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWali_SiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_ayah' => ['required', 'string', 'max:100'],
            'nama_ibu' => ['required', 'string', 'max:100'],
            'tempat_lahir_ayah' => ['required', 'string', 'max:50'],
            'tempat_lahir_ibu' => ['required', 'string', 'max:50'],
            'tanggal_lahir_ayah' => ['required', 'date'],
            'tanggal_lahir_ibu' => ['required', 'date'],
            'nik_ayah' => ['nullable', 'string', 'digits:16'],
            'nik_ibu' => ['nullable', 'string', 'digits:16'],
            'agama_ayah' => ['required', 'string', 'max:20'],
            'agama_ibu' => ['required', 'string', 'max:20'],
            'kewarganegaraan_ayah' => ['required', 'string', 'max:50'],
            'kewarganegaraan_ibu' => ['required', 'string', 'max:50'],
            'pendidikan_ayah' => ['required', 'string', 'max:100'],
            'pendidikan_ibu' => ['required', 'string', 'max:100'],
            'ijazah_ayah' => ['required', 'string', 'max:100'],
            'ijazah_ibu' => ['required', 'string', 'max:100'],
            'pekerjaan_ayah' => ['nullable', 'string', 'max:100'],
            'pekerjaan_ibu' => ['nullable', 'string', 'max:100'],
            'alamat_kerja_ayah' => ['nullable', 'string', 'max:200'],
            'alamat_kerja_ibu' => ['nullable', 'string', 'max:200'],
            'penghasilan_ayah' => ['nullable', 'string', 'max:50'],
            'penghasilan_ibu' => ['nullable', 'string', 'max:50'],
            'alamat_rumah_ayah' => ['nullable', 'string', 'max:200'],
            'alamat_rumah_ibu' => ['nullable', 'string', 'max:200'],
            'status_hidup' => ['required', 'string', 'max:100'],

            // Wali opsional
            'nama_wali' => ['nullable', 'string', 'max:100'],
            'tempat_lahir_wali' => ['nullable', 'string', 'max:50'],
            'tanggal_lahir_wali' => ['nullable', 'date'],
            'nik_wali' => ['nullable', 'string', 'digits:16'],
            'agama_wali' => ['nullable', 'string', 'max:20'],
            'kewarganegaraan_wali' => ['nullable', 'string', 'max:50'],
            'hubungan_keluarga' => ['nullable', 'string', 'max:50'],
            'ijazah_wali' => ['nullable', 'string', 'max:100'],
            'pekerjaan_wali' => ['nullable', 'string', 'max:100'],
            'penghasilan_wali' => ['nullable', 'string', 'max:50'],
            'alamat_rumah_wali' => ['nullable', 'string', 'max:200'],
            'nomor_telp_wali' => ['nullable', 'string', 'max:15'],
        ];
    }
}
