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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // // Baru
            // $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            // $table->string('gender')->nullable();
            // $table->string('agama')->nullable();
            // $table->string('alamat')->nullable();
            // $table->string('sekolah_univ')->nullable();
            // $table->string('jurusan')->nullable();
            // $table->date('tgl_lahir')->nullable();
            // $table->string('no_tlp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
