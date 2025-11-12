<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Admin\LowonganController;
use App\Http\Controllers\Admin\MahasiswaPelajarController;
use App\Http\Controllers\Admin\DaftarMagangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
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
            return Inertia::render('Dashboard');
        })->name('dashboard');

        Route::resource('lowongan', LowonganController::class);
        Route::resource('mahasiswa', MahasiswaPelajarController::class);
        Route::resource('daftarmagang', DaftarMagangController::class);

    });

// ======================
//   User Auth Section
// ======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
