<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory, SoftDeletes, Prunable;
    protected $table = "database_biodata_siswa";
    protected $fillable =  [
        'id_account',
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
        'created_by', 'updated_by', 'deleted_by',
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function jenis_kelamins($value): Attribute
    {
        return new Attribute(
            fn($value)=>['Angkat','Kandung'][$value]
            // kalo 0 = Kandung,1 = tiri, 2 = angkat
        );
    }
    protected function metode_transportasi(): Attribute
    {
        return new Attribute(
            fn($value)=>['Antar','Sendiri'][$value]
            // kalo 0 = Antar,1 = Sendiri
        );
    }
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
}
