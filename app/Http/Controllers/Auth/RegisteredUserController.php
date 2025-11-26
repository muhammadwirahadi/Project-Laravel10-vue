<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            'gender'        => 'required|string|max:50',
            'agama'         => 'required|string|max:100',
            'alamat'        => 'required|string|max:255',
            'sekolah_univ'  => 'required|string|max:255',
            'jurusan'       => 'required|string|max:255',
            'tgl_lahir'     => 'required|date',
            'no_tlp'        => 'required|string|max:20',
        ]);

        // Default role: 2 = user (ganti sesuai struktur tabel roles kamu)
        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'role_id'       => 2,
            'gender'        => $request->gender,
            'agama'         => $request->agama,
            'alamat'        => $request->alamat,
            'sekolah_univ'  => $request->sekolah_univ,
            'jurusan'       => $request->jurusan,
            'tgl_lahir'     => $request->tgl_lahir,
            'no_tlp'        => $request->no_tlp,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // // Redirect berdasarkan role
        // if ($user->role_id == 1) {
        //     // Admin
        //     return redirect()->route('admin.dashboard');
        // }

        // User biasa
        return redirect()->route('verification.notice');
    }
}
