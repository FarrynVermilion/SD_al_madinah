<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Prunable;

class verifikasi_SPP extends Model
{
    use SoftDeletes, Prunable;
    protected $table = 'verifikasi_spp';

    protected $primaryKey = ['id_verifikasi'];
    protected $fillable =  [
        "id_transaksi",
        "status_verifikasi"
    ];
    public $timestamps = true;
}
