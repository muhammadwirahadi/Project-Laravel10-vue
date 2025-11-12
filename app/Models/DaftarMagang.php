<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarMagang extends Model
{
    protected $fillable = [
        'id_user', 'id_lowongan', 'email', 'nama', 'gender', 'agama',
        'alamat', 'sekolah_univ', 'jurusan', 'tgl_lahir', 'no_tlp',
        'durasi', 'cv', 'surat_permohonan_magang', 'surat_pembimbing', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan');
    }
}


?>