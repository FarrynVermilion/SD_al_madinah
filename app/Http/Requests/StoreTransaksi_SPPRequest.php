<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTransaksi_SPPRequest extends FormRequest
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
            "bulan" => ["required", "in:1,2,3,4,5,6"],
            "tahun_ajar" => ["required","in:".date("Y")."/".(date("Y")+1).",".(date("Y")-1)."/".date("Y")],
            "semester" => ["required", "in:0,1"],
        ];
    }
}
