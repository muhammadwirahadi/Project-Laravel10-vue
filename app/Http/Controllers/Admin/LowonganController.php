<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $lowongans = Lowongan::when($search, function ($query) use ($search) {
            $query->where('nama_lowongan', 'LIKE', "%{$search}%");
        })
            ->orderBy('id', 'DESC')
            ->paginate(4)
            ->through(fn($l) => [
                'id' => $l->id,
                'nama_lowongan' => $l->nama_lowongan,
            ]);

        return Inertia::render('Admin/Lowongan/Index', [
            'lowongans' => $lowongans,
            'filters' => [
                'search' => $search,
            ],
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
        $request->validate(['nama_lowongan' => 'required']);
        Lowongan::create($request->only('nama_lowongan'));
        return back();
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lowongan $lowongan)
    {
        $lowongan->delete();
        return back();
    }
}
