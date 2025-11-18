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
        Schema::create('daftarmagangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_lowongan')->constrained('lowongans')->onDelete('cascade');
            // $table->string('email');
            // $table->string('nama');
            // $table->string('gender');
            // $table->string('agama');
            // $table->string('alamat');
            // $table->string('sekolah_univ');
            // $table->string('jurusan');
            // $table->date('tgl_lahir');
            // $table->string('no_tlp');
            $table->string('durasi');
            $table->string('cv')->nullable();
            $table->string('surat_permohonan_magang')->nullable();
            $table->string('surat_pembimbing')->nullable();
            $table->enum('status', ['Pending', 'Diterima', 'Ditolak'])->default('Pending');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftarmagangs');
    }
};
