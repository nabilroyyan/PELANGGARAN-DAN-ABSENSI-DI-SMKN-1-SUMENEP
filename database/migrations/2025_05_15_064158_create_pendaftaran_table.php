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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kelas_siswa')->constrained('kelas_siswa');
            $table->foreignId('id_users')->constrained('users');
            $table->foreignId('id_ekstrakurikuler')->constrained('ekstrakurikuler');
            $table->string('nama_lengkap');
            $table->text('alasan');
            $table->string('nomer_wali');
            $table->enum('status_validasi', ['pending', 'diterima', 'ditolak']);
            $table->unsignedBigInteger('validator_id')->nullable();
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
