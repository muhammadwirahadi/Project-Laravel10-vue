<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('cascade');
            $table->string('gender')->nullable();
            $table->string('agama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('sekolah_univ')->nullable();
            $table->string('jurusan')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('no_tlp')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn([
                'role_id',
                'gender',
                'agama',
                'alamat',
                'sekolah_univ',
                'jurusan',
                'tgl_lahir',
                'no_tlp',
            ]);
        });
    }
};
