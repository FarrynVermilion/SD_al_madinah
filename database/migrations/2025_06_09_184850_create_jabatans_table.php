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
            $table->string("created_by",255);
            $table->string("updated_by",255);
            $table->string("deleted_by",255)->nullable();
        });
        Schema::create('transaksi_jabatan_sekolah', function (Blueprint $table) {
            $table->id("id_transaksi_jabatan_sekolah");
            $table->unsignedBigInteger("id_jabatan");
            $table->unsignedBigInteger("id_account");
            $table->timestamps();
            $table->softDeletes()->nullable();
            $table->string("created_by",255);
            $table->string("updated_by",255);
            $table->string("deleted_by",255)->nullable();
        });
        Schema::create('transaksi_jabatan_wali', function (Blueprint $table) {
            $table->id("id_transaksi_jabatan_wali");
            $table->unsignedBigInteger("id_jabatan");
            $table->string("nama_wali",50);
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
        Schema::dropIfExists('jabatan');
    }
};
