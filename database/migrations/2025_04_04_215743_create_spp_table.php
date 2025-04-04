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
            $table->integer("nominal_spp")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->string("created_by",255)->nullable();
            $table->string("updated_by",255)->nullable();
            $table->string("deleted_by",255)->nullable();
        });
        Schema::create('potongan_spp', function (Blueprint $table) {
            $table->id("id_potongan")->primary();
            $table->integer("potongan_spp")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->string("created_by",255)->nullable();
            $table->string("updated_by",255)->nullable();
            $table->string("deleted_by",255)->nullable();
        });
        Schema::create('spp_siswa', function (Blueprint $table) {
            $table->id("id_spp_siswa")->primary();
            $table->unsignedBigInteger("id_siswa");
            $table->unsignedBigInteger("id_nominal");
            $table->unsignedBigInteger("id_potongan");
            $table->foreign("id_siswa")->references("id")->on("users")->noActionOnDelete()->noActionOnUpdate();
            $table->foreign("id_nominal")->references("id_nominal")->on("nominal_spp")->noActionOnDelete()->noActionOnUpdate();
            $table->foreign("id_potongan")->references("id_potongan")->on("potongan_spp")->noActionOnDelete()->noActionOnUpdate();
            $table->timestamps();
            $table->softDeletes();
            $table->string("created_by",255)->nullable();
            $table->string("updated_by",255)->nullable();
            $table->string("deleted_by",255)->nullable();
        });
        Schema::create('transaksi_spp', function (Blueprint $table) {
            $table->id("id_transaksi")->primary();
            $table->unsignedBigInteger("id_spp");
            $table->foreign("id_spp")->references("id_spp_siswa")->on("spp_siswa")->noActionOnDelete()->noActionOnUpdate();
            $table->integer("bayar")->unsigned();
            $table->integer("sisa")->unsigned();
            $table->integer("bulan")->unsigned();
            $table->integer("tahun_ajaran")->unsigned();
            $table->boolean("status_lunas");
            $table->timestamps();
            $table->softDeletes();
            $table->string("created_by",255)->nullable();
            $table->string("updated_by",255)->nullable();
            $table->string("deleted_by",255)->nullable();
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
    }
};
