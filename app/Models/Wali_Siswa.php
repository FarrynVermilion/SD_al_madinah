<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Builder;

class Wali_Siswa extends Model
{
    use SoftDeletes, Prunable;
    protected $table = "wali_siswa";
    protected $fillable =  [
        'id_siswa',
        'nama_ayah',
        'nama_ibu',
        'tempat_lahir_ayah',
        'tem$pat_lahir_ibu',
        'tanggal_lahir_ayah',
        'tanggal_lahir_ibu',
        'nik_ayah',
        'nik_ibu',
        'agama_ayah',
        'agama_ibu',
        'kewarganegaraan_ayah',
        'kewarganegaraan_ibu',
        'pendidikan_ayah',
        'pendidikan_ibu',
        'ijazah_ayah',
        'ijazah_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'alamat_kerja_ayah',
        'alamat_kerja_ibu',
        'penghasilan_ayah',
        'penghasilan_ibu',
        'alamat_rumah_ayah',
        'alamat_rumah_ibu',
        'status_hidup',
        'nama_wali',
        'tempat_lahir_wali',
        'tanggal_lahit_wali',
        'nik_wali',
        'agama_wali',
        'kewarganegaraan_wali',
        'hubungan_keluarga',
        'ijazah_wali',
        'pekerjaan_wali',
        'penghasilan_wali',
        'alamat_rumah_wali',
        'nomor_telp_wali'
    ];
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected static function boot()
    {
        // updating created_by and updated_by when model is created
        parent::boot();
        static::creating(function($model)
        {
            $user = Auth::user();
            $model->created_by = $user->id;
            $model->updated_by = $user->id;
        });
        // updating updated_by when model is updated
        static::updating(function($model)
        {
            $model->updated_by = Auth::user()->id;
        });
        // creating deleted_by when model is deleted
        static::deleting(function ($model)
        {
            $model->deleted_by = Auth::user()->id;
        });
    }

    //get data to delete permanently
    public function prunable(): Builder
    {
        return static::withTrashed()->whereNotNull("deleted_at");
    }
}
