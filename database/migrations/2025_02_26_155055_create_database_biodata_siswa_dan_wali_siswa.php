<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('database_biodata_siswa', function (Blueprint $table) {
            $table->id()->primary();
            $table->unsignedBigInteger('id_account');
            // $table->foreignId('id_account')->references('id')->on('users')->onDelete('cascade');
            $table->string('nama_lengkap',255);
            $table->string('nama_panggilan',100);
            $table->char('jenis_kelamin',1);
            $table->string('tempat_lahir',100);
            $table->date('tanggal_lahir');
            $table->string('agama',50);
            $table->string('kewarganegaraan',50);
            $table->tinyInteger('anak_ke');
            $table->tinyInteger('jumlah_saudara_kandung');
            $table->tinyInteger('jumlah_saudara_tiri')->nullable();
            $table->tinyInteger('jumlah_saudara_angkat')->nullable();
            $table->char('status_anak',1)->nullable();
            $table->string('bahasa_sehari_hari',100);
            $table->text('alamat');
            $table->string('no_kk',20);
            $table->string('kelurahan',100);
            $table->string('kecamatan',100);
            $table->string('kota',100);
            $table->string('kode_pos',20);
            $table->string('nomor_telepon',20);
            $table->char('tempat_alamat',1);
            $table->string('nama_pemilik_tempat_alamat',100);
            $table->integer('jarak_ke_sekolah')->nullable();
            $table->char('metode_transportasi',1);
            $table->string('golongan_darah',3)->nullable();
            $table->string('riwayat_rawat',100)->nullable();
            $table->char('riwayat_penyakit',1)->nullable();
            $table->string('kelainan_jasmani',255)->nullable();
            $table->smallInteger('tinggi_badan')->nullable();
            $table->smallInteger('berat_badan')->nullable();
            $table->string('nama_sekolah_asal',255)->nullable();
            $table->date('tanggal_ijazah')->nullable();
            $table->string('nomor_ijazah',100)->nullable();
            $table->date('tanggal_skhun')->nullable();
            $table->string('nomor_skhun',100)->nullable();
            $table->tinyInteger('lama_belajar')->nullable();
            $table->string('nisn',100)->nullable();
            $table->char('tipe_riwayat_sekolah',1)->nullable();
            $table->string('nama_riwayat_sekolah',255)->nullable();
            $table->date('tanggal_pindah')->nullable();
            $table->text('alasan_pindah')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();
            $table->string("created_by",255);
            $table->string("updated_by",255);
            $table->string("deleted_by",255)->nullable();
        });
        Schema::create('database_biodata_wali_siswa', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('id_siswa');
            $table->string('nama_ayah',100);
            $table->string('nama_ibu',100);
            $table->string('tempat_lahir_ayah',50);
            $table->string('tempat_lahir_ibu',50);
            $table->date('tanggal_lahir_ayah');
            $table->date('tanggal_lahir_ibu');
            $table->string('nik_ayah',16)->nullable();
            $table->string('nik_ibu',16)->nullable();
            $table->string('agama_ayah',20);
            $table->string('agama_ibu',20);
            $table->string('kewarganegaraan_ayah',50);
            $table->string('kewarganegaraan_ibu',50);
            $table->string('pendidikan_ayah',100);
            $table->string('pendidikan_ibu',100);
            $table->string('ijazah_ayah',100);
            $table->string('ijazah_ibu',100);
            $table->string('pekerjaan_ayah',100)->nullable();
            $table->string('pekerjaan_ibu',100)->nullable();
            $table->string('alamat_kerja_ayah',200)->nullable();
            $table->string('alamat_kerja_ibu',200)->nullable();
            $table->string('penghasilan_ayah',50)->nullable();
            $table->string('penghasilan_ibu',50)->nullable();
            $table->string('alamat_rumah_ayah',200)->nullable();
            $table->string('alamat_rumah_ibu',200)->nullable();
            $table->string('status_hidup',100);
            $table->string('nama_wali',100)->nullable();
            $table->string('tempat_lahir_wali',50)->nullable();
            $table->date('tanggal_lahir_wali')->nullable();
            $table->string('nik_wali',16)->nullable();
            $table->string('agama_wali',20)->nullable();
            $table->string('kewarganegaraan_wali',50)->nullable();
            $table->string('hubungan_keluarga',50)->nullable();
            $table->string('ijazah_wali',100)->nullable();
            $table->string('pekerjaan_wali',100)->nullable();
            $table->string('penghasilan_wali',50)->nullable();
            $table->string('alamat_rumah_wali',200)->nullable();
            $table->string('nomor_telp_wali',15)->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();
            $table->string("created_by",255);
            $table->string("updated_by",255);
            $table->string("deleted_by",255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('database_biodata_siswa');
        Schema::dropIfExists('database_biodata_wali_siswa');
    }
};
