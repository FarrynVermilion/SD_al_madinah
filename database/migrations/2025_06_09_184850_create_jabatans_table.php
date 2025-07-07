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
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id("id_jabatan");
            $table->string("nama_jabatan",50);
            $table->boolean("jenis_jabatan");
            $table->timestamps();
            $table->softDeletes()->nullable();
            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("updated_by");
            $table->unsignedBigInteger("deleted_by")->nullable();
        });
        Schema::create('transaksi_jabatan_sekolah', function (Blueprint $table) {
            $table->id("id_transaksi_jabatan_sekolah");
            $table->unsignedBigInteger("id_jabatan");
            $table->unsignedBigInteger("id_account");
            $table->timestamps();
            $table->softDeletes()->nullable();
            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("updated_by");
            $table->unsignedBigInteger("deleted_by")->nullable();
        });
        Schema::create('transaksi_jabatan_wali', function (Blueprint $table) {
            $table->id("id_transaksi_jabatan_wali");
            $table->unsignedBigInteger("id_jabatan");
            $table->string("nama_wali",50);
            $table->timestamps();
            $table->softDeletes()->nullable();
            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("updated_by");
            $table->unsignedBigInteger("deleted_by")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan');
    }
};
