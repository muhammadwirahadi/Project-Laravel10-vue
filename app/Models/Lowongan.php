<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $fillable = ['nama_lowongan'];

    public function daftarMagang()
    {
        return $this->hasMany(DaftarMagang::class, 'id_lowongan');
    }
}
