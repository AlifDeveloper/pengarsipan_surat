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
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->string('no_suratkeluar')->primary();
            $table->date('tgl_surat');
            $table->string('tujuan');
            $table->string('perihal');
            $table->string('kode_arsip');
            $table->string('nip');
            $table->foreign('kode_arsip')->references('kode_arsip')->on('klasifikasi_arsip')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('nip')->references('nip')->on('petugas')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};
