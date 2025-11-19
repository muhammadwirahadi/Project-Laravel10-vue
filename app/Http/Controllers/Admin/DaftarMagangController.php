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
    public function index(Request $request)
    {
        // Ambil keyword pencarian dari query string
        $search = $request->query('search');

        // Query dengan search + pagination
        $daftarMagangs = DaftarMagang::with(['user', 'lowongan'])
            ->when($search, function ($query) use ($search) {

                // Search berdasarkan user
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('no_tlp', 'LIKE', "%{$search}%")
                        ->orWhere('sekolah_univ', 'LIKE', "%{$search}%")
                        ->orWhere('jurusan', 'LIKE', "%{$search}%");
                });

                // Search berdasarkan lowongan
                $query->orWhereHas('lowongan', function ($q) use ($search) {
                    $q->where('nama_lowongan', 'LIKE', "%{$search}%");
                });

                // Search kolom daftar_magang
                $query->orWhere('durasi', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%")
                    ->orWhereDate('created_at', $search);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(4)
            ->withQueryString()
            ->through(function ($d) {
                return [
                    'id' => $d->id,

                    // User
                    'nama' => $d->user->name ?? '-',
                    'email' => $d->user->email ?? '-',
                    'no_tlp' => $d->user->no_tlp ?? '-',
                    'jurusan' => $d->user->jurusan ?? '-',

                    // Daftar Magang
                    'durasi' => $d->durasi,
                    'status' => $d->status,
                    'created_at' => $d->created_at,
                    'lowongan' => $d->lowongan,

                    // File
                    'cv_url' => $d->cv ? asset('storage/' . $d->cv) : null,
                    'surat_permohonan_url' => $d->surat_permohonan_magang ? asset('storage/' . $d->surat_permohonan_magang) : null,
                    'pembimbing_url' => $d->surat_pembimbing ? asset('storage/' . $d->surat_pembimbing) : null,
                ];
            });


        return Inertia::render('Admin/DaftarMagang/Index', [
            'daftarMagangs' => $daftarMagangs,
            'filters' => [
                'search' => $search, // dikirim ke vue untuk input search
            ]
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
        // Cek apakah user sudah daftar 3 kali
        $count = DaftarMagang::where('id_user', Auth::id())->count();

        if ($count >= 3) {
            return back()->with('error', 'Anda hanya bisa mendaftar maksimal 3 kali.');
        }

        $validated = $request->validate([
            'id_lowongan' => 'required',
            'durasi' => 'required|integer|min:1|max:12',

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
