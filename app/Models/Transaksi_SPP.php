<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Builder;

class Transaksi_SPP extends Model
{
    use SoftDeletes, Prunable;
    protected $table = "transaksi_spp";
    protected $fillable =  [
        'spp',
        'potongan',
        'transaksi',
        'sisa_pembayaran',
        'bulan',
        'tahun_ajaran',
        'status_lunas'
    ];
    protected $primaryKey = 'id_transaksi';
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
