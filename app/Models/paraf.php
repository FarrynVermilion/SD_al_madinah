<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Builder;

class paraf extends Model
{
    use SoftDeletes;
    protected $table = 'paraf';
    protected $primaryKey = 'id_paraf';
    public $timestamps = true;
    public $fillable = [
        'image_paraf_path',
    ];

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
