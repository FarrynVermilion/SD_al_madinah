<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Thiagoprz\CompositeKey\HasCompositeKey;
use Illuminate\Support\Facades\Auth;

class Siswa_Kelas extends Model
{
    use SoftDeletes,HasCompositeKey;
    protected $table = 'siswa_kelas';
    protected $primaryKey = [
        'id_siswa',
        'id_kelas',
        'tahun_ajaran'
    ];
    protected $fillable = [
        'id_siswa',
        'id_kelas',
        'tahun_ajaran'
    ];
    public $timestamps = true;
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
}
