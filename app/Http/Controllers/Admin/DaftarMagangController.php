<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\DaftarMagang;

class DaftarMagangController extends Controller
{
    public function index()
    {
        $daftarMagangs = DaftarMagang::with(['user', 'lowongan'])->get();

        return Inertia::render('Admin/DaftarMagang/Index', [
            'daftarMagangs' => $daftarMagangs
        ]);
    }
}
