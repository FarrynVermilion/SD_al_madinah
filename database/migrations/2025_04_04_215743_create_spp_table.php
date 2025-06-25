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
        Schema::create('nominal_spp', function (Blueprint $table) {
            $table->id("id_nominal")->primary();
            $table->string("nama_bayaran",50);
            $table->decimal("nominal",9,2)->unsigned();
            $table->timestamps();
            $table->softDeletes()->nullable();
            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("updated_by");
            $table->unsignedBigInteger("deleted_by")->nullable();
        });
        Schema::create('potongan_spp', function (Blueprint $table) {
            $table->id("id_potongan")->primary();
            $table->string("nama_potongan",50);
            $table->decimal("nominal_potongan"."",9,2)->unsigned();
            $table->timestamps();
            $table->softDeletes()->nullable();
            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("updated_by");
            $table->unsignedBigInteger("deleted_by")->nullable();
        });

        //default settting bayaran siswa
        Schema::create('spp_siswa', function (Blueprint $table) {
            $table->id("id_spp_siswa")->primary();
            $table->unsignedBigInteger("id_siswa");
            $table->unsignedBigInteger("id_nominal");
            $table->unsignedBigInteger("id_potongan")->nullable();
            // $table->foreign("id_siswa")->references("id")->on("users")->noActionOnDelete()->noActionOnUpdate();
            // $table->foreign("id_nominal")->references("id_nominal")->on("nominal_spp")->noActionOnDelete()->noActionOnUpdate();
            $table->boolean("status_siswa")->default(true);
            $table->timestamps();
            $table->softDeletes()->nullable();
            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("updated_by");
            $table->unsignedBigInteger("deleted_by")->nullable();
        });
        //transaksi + ptongan tambahan siswa
        //key enkripsi = no kk|nama_lengkap kurang tambahin 0000 sampe 16 byte lebih potong sampe 16 byte
        Schema::create('transaksi_spp', function (Blueprint $table) {
            $table->id("id_transaksi")->primary();
            // di hapus soalnya kalau ada perubahan spp atau potongan bakal berubah jadi langsung
            // aja gk pake fk
            $table->unsignedBigInteger("id_spp");
            // $table->foreign("id_spp")->references("id_spp_siswa")->on("spp_siswa")->noActionOnDelete()->noActionOnUpdate();
            // $table->foreign("id_potongan")->references("id_potongan")->on("potongan_spp")->noActionOnDelete()->noActionOnUpdate();
            $table->decimal("spp",9,2)->unsigned();
            $table->decimal("potongan",9,2)->unsigned();
            $table->tinyInteger("bulan")->unsigned();
            $table->boolean("semester");
            $table->string("tahun_ajaran",9);
            $table->string("status_lunas");
            $table->unsignedBigInteger("id_ketua_komite")->nullable();
            $table->string("nama_ketua_komite")->nullable();
            $table->unsignedBigInteger("id_kepala_sekolah")->nullable();
            $table->string("kepala_sekolah")->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();
            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("updated_by")->nullable();
            $table->unsignedBigInteger("deleted_by")->nullable();
        });
        Schema::create('verifikasi_spp', function (Blueprint $table) {
            $table->id("id_verifikasi_spp")->primary();
            $table->unsignedBigInteger("id_transaksi");
            $table->boolean("status_verifikasi");
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominal_spp');
        Schema::dropIfExists('potongan_spp');
        Schema::dropIfExists('spp_siswa');
        Schema::dropIfExists('transaksi_spp');
        Schema::dropIfExists('verifikasi_spp');
    }
};
