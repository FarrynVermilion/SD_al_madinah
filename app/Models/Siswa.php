<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Builder;

class Siswa extends Model
{
    use SoftDeletes, Prunable;
    protected $table = "siswa";
    protected $fillable =  [
        'id_account',
        'id_beasiswa',
        'nama_lengkap',
        'nama_panggilan',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'kewarganegaraan',
        'anak_ke',
        'jumlah_saudara_kandung',
        'jumlah_saudara_tiri',
        'jumlah_saudara_angkat',
        'status_anak',
        'bahasa_sehari_hari',
        'alamat',
        'no_kk',
        'kelurahan',
        'kecamatan',
        'kota',
        'kode_pos',
        'nomor_telepon',
        'tempat_alamat',
        'nama_pemilik_tempat_alamat',
        'jarak_ke_sekolah',
        'metode_transportasi',
        'golongan_darah',
        'riwayat_rawat',
        'riwayat_penyakit',
        'kelainan_jasmani',
        'tinggi_badan',
        'berat_badan',
        'nama_sekolah_asal',
        'tanggal_ijazah',
        'nomor_ijazah',
        'tanggal_skhun',
        'nomor_skhun',
        'lama_belajar',
        'nisn',
        'tipe_riwayat_sekolah',
        'nama_riwayat_sekolah',
        'tanggal_pindah',
        'alasan_pindah',
    ];
    public function jenis_kelamin(): Attribute
    {
        return Attribute::make(
            fn($value)=>['Laki laki','Perempuan'][$value]
            // kalo 0 = Laki laki, 1 Perempuan
        );
    }
    public function tipe_riwayat_sekolah(): Attribute
    {
        return Attribute::make(
            fn($value)=>['Baru','Pindah'][$value]
            // kalo 0 = Baru, 1 Pindah
        );
    }
    public function riwayat_penyakit(): Attribute
    {
        return Attribute::make(
            fn($value)=>['Tidak punya','Punya'][$value]
            // kalo 0 = Tidak Punya, 1 Punya
        );
    }
    public function tempat_alamat(): Attribute
    {
        return Attribute::make(
            fn($value)=>['Sewa','Milik'][$value]
            // kalo 0 = Sewa, 1 Milik
        );
    }
    public function status_anak(): Attribute
    {
        return Attribute::make(
            fn($value)=>['Nukan','Kandung'][$value]
            // kalo 0 = Nukan, 1 Kandung
        );
    }
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
