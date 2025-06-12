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
        Schema::create('petugas', function (Blueprint $table) {
            $table->string('nip')->primary();
            $table->string('nama');
            $table->date('tgl_lahir');
            $table->string('jabatan');
            $table->string('alamat');
            $table->string('no_telp');
            // $table->foreignId('id_users')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas');
    }
};
