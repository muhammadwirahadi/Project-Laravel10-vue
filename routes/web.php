<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Admin\LowonganController;
use App\Http\Controllers\Admin\MahasiswaPelajarController;
use App\Http\Controllers\Admin\DaftarMagangController;
use App\Models\Lowongan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'lowongans' => Lowongan::all(),
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});




// ======================
//   Admin Only Section
// ======================
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Admin/Dashboard/Dashboard');
        })->name('dashboard');

        Route::resource('lowongan', LowonganController::class);
        Route::resource('mahasiswa', MahasiswaPelajarController::class);
        Route::resource('daftarmagang', DaftarMagangController::class);
        Route::put('/daftar-magang/{id}/status', [DaftarMagangController::class, 'updateStatus']);
        Route::get('/admin/daftarmagang', [DaftarMagangController::class, 'index'])->name('daftarmagang.index');

    });

// ======================
//   User Auth Section
// ======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/daftar-magang', [DaftarMagangController::class, 'store'])
    ->name('daftar.magang.store');
});

require __DIR__.'/auth.php';
