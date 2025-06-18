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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id("id_kelas")->primary();
            $table->string("nama_kelas",10);
            $table->timestamps();
            $table->softDeletes()->nullable();
            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("updated_by");
            $table->unsignedBigInteger("deleted_by")->nullable();
        });
        Schema::create('siswa_kelas', function (Blueprint $table) {
            $table->id("id_siswa_kelas")->primary();
            $table->unsignedBigInteger("id_siswa");
            $table->unsignedBigInteger("id_kelas");
            $table->timestamps();
            $table->softDeletes()->nullable();
            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("updated_by");
            $table->unsignedBigInteger("deleted_by")->nullable();
        });
        Schema::create('NIS', function (Blueprint $table) {
            $table->char("id_NIS",7)->primary();
            $table->unsignedBigInteger("id_siswa");
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
        Schema::dropIfExists('kelas');
        Schema::dropIfExists('transaksi_siswa_kelas');
        Schema::dropIfExists('NIS');
    }
};
