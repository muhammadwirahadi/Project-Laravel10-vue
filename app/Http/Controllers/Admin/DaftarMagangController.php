<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\DaftarMagang;
use Illuminate\Support\Facades\Auth;

class DaftarMagangController extends Controller
{
    public function index()
    {
        // $daftarMagangs = DaftarMagang::with(['user', 'lowongan'])->get();
        $daftarMagangs = DaftarMagang::with(['user', 'lowongan'])
            ->get()
            ->map(function ($d) {
                return [
                    'id' => $d->id,
                    'nama' => $d->nama,
                    'email' => $d->email,
                    'no_tlp' => $d->no_tlp,
                    'durasi' => $d->durasi,
                    'status' => $d->status,
                    'created_at' => $d->created_at,
                    'lowongan' => $d->lowongan,
                    'cv' => $d->cv,
                    'surat_permohonan_magang' => $d->surat_permohonan_magang,
                    'surat_pembimbing' => $d->surat_pembimbing,
                    // URL FILE PREVIEW
                    'cv_url' => $d->cv ? asset('storage/' . $d->cv) : null,
                    'surat_permohonan_url' => $d->surat_permohonan_magang ? asset('storage/' . $d->surat_permohonan_magang) : null,
                    'pembimbing_url' => $d->surat_pembimbing ? asset('storage/' . $d->surat_pembimbing) : null,
                ];
            });

            
        // dd($daftarMagangs);
        return Inertia::render('Admin/DaftarMagang/Index', [
            'daftarMagangs' => $daftarMagangs
        ]);
    }

    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:Pending,Diterima,Ditolak'
        ]);

        $daftar = DaftarMagang::findOrFail($id);
        $daftar->status = $request->status;
        $daftar->save();

        return back()->with('success', 'Status berhasil diperbarui!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_lowongan' => 'required',
            'email' => 'required|email',
            'nama' => 'required|string',
            'gender' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'sekolah_univ' => 'required',
            'jurusan' => 'required',
            'tgl_lahir' => 'required|date',
            'no_tlp' => 'required',
            'durasi' => 'required',
            'cv' => 'required|file|mimes:pdf|max:2048',
            'surat_permohonan_magang' => 'required|file|mimes:pdf|max:2048',
            'surat_pembimbing' => 'required|file|mimes:pdf|max:2048',
        ]);

        // upload files
        $validated['cv'] = $request->file('cv')->store('cv', 'public');
        $validated['surat_permohonan_magang'] = $request->file('surat_permohonan_magang')->store('permohonan', 'public');
        $validated['surat_pembimbing'] = $request->file('surat_pembimbing')->store('pembimbing', 'public');

        $validated['id_user'] = Auth::id();
        DaftarMagang::create($validated);

        return back()->with('success', 'Pendaftaran berhasil dikirim!');
        
    }
}
