<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreSiswaRequest extends FormRequest
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
     * @return array<string=>[], \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // akun
            "email" => "required|string|email|unique:users,email",
            // siswa
            // 'id_account' => 'required|exists:users,id',
            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:0,1',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:50',
            'kewarganegaraan' => 'required|string|max:50',
            'anak_ke' => 'required|integer|min:1',
            'jumlah_saudara_kandung' => 'required|integer|min:0',
            'jumlah_saudara_tiri' => 'nullable|integer|min:0',
            'jumlah_saudara_angkat' => 'nullable|integer|min:0',
            'status_anak' => 'nullable|in:0,1,2',
            'bahasa_sehari_hari' => 'required|string|max:100',
            'alamat' => 'required|string',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kota' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:20',
            'nomor_telepon' => 'required|string|max:20',
            'tempat_alamat' => 'required|in:0,1',
            'nama_pemilik_tempat_alamat' => 'required|string|max:100',
            'jarak_ke_sekolah' => 'nullable|integer|min:0',
            'metode_transportasi' => 'required|in:0,1',
            'golongan_darah' => 'nullable|in:,O?,O+,O-,A?,A+,A-,B?,B+,B-,AB?,AB+,AB-',
            'riwayat_penyakit' => 'nullable|in:0,1',
            'riwayat_rawat' => 'nullable|string|max:100',
            'kelainan_jasmani' => 'nullable|string|max:255',
            'tinggi_badan' => 'nullable|integer|min:0|max:300',
            'berat_badan' => 'nullable|integer|min:0|max:300',
            'nama_sekolah_asal' => 'nullable|string|max:255',
            'tanggal_ijazah' => 'nullable|date',
            'nomor_ijazah' => 'nullable|string|max:100',
            'tanggal_skhun' => 'nullable|date',
            'nomor_skhun' => 'nullable|string|max:100',
            'lama_belajar' => 'nullable|integer|min:0|max:20',
            'nisn' => 'required|string|max:10|min:10',
            'tipe_riwayat_sekolah' => 'nullable|in:0,1',
            'nama_riwayat_sekolah' => 'nullable|string|max:255',
            'tanggal_pindah' => 'nullable|date',
            'alasan_pindah' => 'nullable|string',

            // contoller
            'pilih_data_kk' => 'required',
            'no_kk' => 'required|string|size:16',
            'status_hidup' => ['nullable', 'string', 'max:100'],

            // Orang Tua
            'nama_ayah' => ['nullable', 'string', 'max:100'],
            'nama_ibu' => ['nullable', 'string', 'max:100'],
            'tempat_lahir_ayah' => ['nullable', 'string', 'max:50'],
            'tempat_lahir_ibu' => ['nullable', 'string', 'max:50'],
            'tanggal_lahir_ayah' => ['nullable', 'date'],
            'tanggal_lahir_ibu' => ['nullable', 'date'],
            'nik_ayah' => ['nullable', 'string', 'size:16'],
            'nik_ibu' => ['nullable', 'string', 'size:16'],
            'agama_ayah' => ['nullable', 'string', 'max:20'],
            'agama_ibu' => ['nullable', 'string', 'max:20'],
            'kewarganegaraan_ayah' => ['nullable', 'string', 'max:50'],
            'kewarganegaraan_ibu' => ['nullable', 'string', 'max:50'],
            'pendidikan_ayah' => ['nullable', 'string', 'max:100'],
            'pendidikan_ibu' => ['nullable', 'string', 'max:100'],
            'ijazah_ayah' => ['nullable', 'string', 'max:100'],
            'ijazah_ibu' => ['nullable', 'string', 'max:100'],
            'pekerjaan_ayah' => ['nullable', 'string', 'max:100'],
            'pekerjaan_ibu' => ['nullable', 'string', 'max:100'],
            'alamat_kerja_ayah' => ['nullable', 'string', 'max:200'],
            'alamat_kerja_ibu' => ['nullable', 'string', 'max:200'],
            'penghasilan_ayah' => ['nullable', 'string', 'max:50'],
            'penghasilan_ibu' => ['nullable', 'string', 'max:50'],
            'alamat_rumah_ayah' => ['nullable', 'string', 'max:200'],
            'alamat_rumah_ibu' => ['nullable', 'string', 'max:200'],

            // Wali opsional
            'nama_wali' => ['nullable', 'string', 'max:100'],
            'tempat_lahir_wali' => ['nullable', 'string', 'max:50'],
            'tanggal_lahir_wali' => ['nullable', 'date'],
            'nik_wali' => ['nullable', 'string', 'size:16'],
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
