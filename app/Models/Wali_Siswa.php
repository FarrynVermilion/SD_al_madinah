<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Testing\Fluent\Concerns\Has;

class Wali_Siswa extends Model
{
    use SoftDeletes, Prunable, HasFactory;
    protected $table = "database_biodata_wali_siswa";
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
        'nomor_telp_wali',
        'created_by', 'updated_by', 'deleted_by',
        'created_at', 'updated_at', 'deleted_at'
    ];
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $hidden = [  ];
    protected static function boot()
    {
        // updating created_by and updated_by when model is created
        parent::boot();

        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = Auth::user()->id;
            }
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = Auth::user()->id;
            }
        });

        // updating updated_by when model is updated
        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = Auth::user()->id;
            }
        });

        // creating deleted_by when model is deleted
        static::deleting(function ($model) {
            if (!$model->isDirty('deleted_by')) {
                $model->deleted_by = Auth::user()->id;
                $model->save();
            }
        });
    }

    //get data to delete permanently
    public function prunable(): Builder
    {
        return static::withTrashed()->whereNotNull("deleted_at");
    }
}
