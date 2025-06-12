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
        Schema::create('disposisi', function (Blueprint $table) {
            $table->string('no_disposisi')->primary();
            $table->string('no_suratmasuk');
            $table->foreign('no_suratmasuk')->references('no_suratmasuk')->on('surat_masuk')->onUpdate('cascade')->onDelete('cascade');
            $table->date('tgl_diterima');
            $table->string('perihal');
            $table->string('tujuan_surat');
            $table->string('kode_sifat');
            $table->string('nip');
            $table->foreign('nip')->references('nip')->on('petugas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kode_sifat')->references('kode_sifat')->on('sifat_arsip')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisi');
    }
};
