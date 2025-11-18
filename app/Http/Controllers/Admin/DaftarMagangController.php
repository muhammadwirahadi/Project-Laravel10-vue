<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\DaftarMagang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DaftarMagangController extends Controller
{
    public function index()
    {
        $daftarMagangs = DaftarMagang::with(['user', 'lowongan'])
            ->get()
            ->map(function ($d) {
                return [
                    'id' => $d->id,

                    // Data dari tabel users
                    'nama' => $d->user->name ?? '-',
                    'email' => $d->user->email ?? '-',
                    'no_tlp' => $d->user->no_tlp ?? '-',
                    'gender' => $d->user->gender ?? '-',
                    'agama' => $d->user->agama ?? '-',
                    'alamat' => $d->user->alamat ?? '-',
                    'sekolah_univ' => $d->user->sekolah_univ ?? '-',
                    'jurusan' => $d->user->jurusan ?? '-',
                    'tgl_lahir' => $d->user->tgl_lahir ?? '-',

                    // Data dari tabel daftar_magang
                    'durasi' => $d->durasi,
                    'status' => $d->status,
                    'created_at' => $d->created_at,
                    'lowongan' => $d->lowongan,

                    // File URL
                    'cv_url' => $d->cv ? asset('storage/' . $d->cv) : null,
                    'surat_permohonan_url' =>
                    $d->surat_permohonan_magang ? asset('storage/' . $d->surat_permohonan_magang) : null,
                    'pembimbing_url' =>
                    $d->surat_pembimbing ? asset('storage/' . $d->surat_pembimbing) : null,
                ];
            });

        return Inertia::render('Admin/DaftarMagang/Index', [
            'daftarMagangs' => $daftarMagangs
        ]);
    }

    public function updateStatus($id, Request $request)
    {
        // Ini untuk ketika status Ditolak Cv, Surat Permohonan magang, Surat Pembimbing masih bisa dilihat oleh admin
        $request->validate([
            'status' => 'required|in:Pending,Diterima,Ditolak'
        ]);

        $daftar = DaftarMagang::findOrFail($id);
        $daftar->status = $request->status;
        $daftar->save();

        return back()->with('success', 'Status berhasil diperbarui!');

        // // Ini untuk ketika status Ditolak Cv, Surat Permohonan magang, Surat Pembimbing sudah tidak bisa dilihat oleh admin
        // $request->validate([
        //     'status' => 'required|in:Pending,Diterima,Ditolak'
        // ]);

        // $daftar = DaftarMagang::findOrFail($id);
        // $oldStatus = $daftar->status;

        // // Update status
        // $daftar->status = $request->status;
        // $daftar->save();

        // // Jika status menjadi Ditolak => hapus file-file terkait
        // if ($request->status === 'Ditolak') {

        //     if ($daftar->cv && Storage::disk('public')->exists($daftar->cv)) {
        //         Storage::disk('public')->delete($daftar->cv);
        //     }

        //     if ($daftar->surat_permohonan_magang && Storage::disk('public')->exists($daftar->surat_permohonan_magang)) {
        //         Storage::disk('public')->delete($daftar->surat_permohonan_magang);
        //     }

        //     if ($daftar->surat_pembimbing && Storage::disk('public')->exists($daftar->surat_pembimbing)) {
        //         Storage::disk('public')->delete($daftar->surat_pembimbing);
        //     }

        //     // Reset Kolom file di database
        //     $daftar->update([
        //         'cv' => null,
        //         'surat_permohonan_magang' => null,
        //         'surat_pembimbing' => null
        //     ]);
        // }

        // return back()->with('success', 'Status berhasil diperbarui!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_lowongan' => 'required',
            'durasi' => 'required',

            // File Upload
            'cv' => 'required|file|mimes:pdf|max:2048',
            'surat_permohonan_magang' => 'required|file|mimes:pdf|max:2048',
            'surat_pembimbing' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Upload file
        $validated['cv'] = $request->file('cv')->store('cv', 'public');
        $validated['surat_permohonan_magang'] = $request->file('surat_permohonan_magang')->store('permohonan', 'public');
        $validated['surat_pembimbing'] = $request->file('surat_pembimbing')->store('pembimbing', 'public');

        // Simpan Id User yang login
        $validated['id_user'] = Auth::id();

        DaftarMagang::create($validated);

        return back()->with('success', 'Pendaftaran berhasil dikirim!');
    }

    public function destroy($id)
    {
        $data = DaftarMagang::findOrFail($id);

        // Hapus file CV
        if ($data->cv && Storage::disk('public')->exists($data->cv)) {
            Storage::disk('public')->delete($data->cv);
        }

        // Hapus Surat Permohonan Magang
        if ($data->surat_permohonan_magang && Storage::disk('public')->exists($data->surat_permohonan_magang)) {
            Storage::disk('public')->delete($data->surat_permohonan_magang);
        }

        // Hapus Surat Pembimbing
        if ($data->surat_pembimbing && Storage::disk('public')->exists($data->surat_pembimbing)) {
            Storage::disk('public')->delete($data->surat_pembimbing);
        }

        // Hapus data pendaftar
        $data->delete();

        return back()->with('success', 'Data pendaftar dan semua file berhasil dihapus.');
    }
}
