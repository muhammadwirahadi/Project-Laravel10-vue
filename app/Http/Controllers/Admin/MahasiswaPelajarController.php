<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;

class MahasiswaPelajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::where('role_id', 2); 

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('gender', 'like', '%' . $request->search . '%')
                    ->orWhere('agama', 'like', '%' . $request->search . '%')
                    ->orWhere('alamat', 'like', '%' . $request->search . '%')
                    ->orWhere('sekolah_univ', 'like', '%' . $request->search . '%')
                    ->orWhere('jurusan', 'like', '%' . $request->search . '%')
                    ->orWhere('tgl_lahir', 'like', '%' . $request->search . '%')
                    ->orWhere('no_tlp', 'like', '%' . $request->search . '%')
                ;
            });
        }


        return Inertia::render('Admin/MahasiswaPelajar/Index', [
            'mahasiswas' => $query->paginate(5)->withQueryString(),
            'filters' => [
                'search' => $request->search ?? ''
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'gender' => 'nullable|string|max:50',
            'agama' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'sekolah_univ' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'no_tlp' => 'nullable|string|max:20',
        ]);

        $user->update($request->all());
        return redirect()->back()->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role_id !== 2) {
            return redirect()->back()->with('error', 'Data ini bukan mahasiswa/pelajar');
        }

        $user->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
