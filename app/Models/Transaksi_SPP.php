<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Transaksi_SPP extends Model
{
    use SoftDeletes, Prunable;
    protected $table = "transaksi_spp";
    protected $fillable =  [
        'id_spp',
        'spp',
        'potongan',
        'bulan',
        'tahun_ajaran',
        'semester',
        'nama_kelas',
        'status_lunas',
        'id_ketua_komite',
        'nama_ketua_komite',
        'id_kepala_sekolah',
        'kepala_sekolah',
        'bukti_potongan'
    ];

    protected $primaryKey = 'id_transaksi';
    public $timestamps = true;

    public function getSemester(): Attribute
    {
        return new Attribute(
            fn($value)=>['Ganjil','Genap'][$value]
        );
    }
    protected static function boot()
    {
        // updating created_by and updated_by when model is created
        parent::boot();
        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = Auth::user()->id;
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
