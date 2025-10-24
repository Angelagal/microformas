<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\ProfileController;
use App\Models\BitacoraAcceso;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Página de inicio
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Dashboard (solo usuarios autenticados y verificados)
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas para invitados (no autenticados)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Formulario de registro
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    // Guardar nuevo usuario
    Route::post('/register', [RegisteredUserController::class, 'store']);

    // El login lo maneja Laravel Breeze por defecto
});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Página de bienvenida después del login o registro
    Route::get('/welcome', function () {
        return Inertia::render('Welcome');
    })->name('welcome');

    /*
     * Rutas de la bitácora de accesos
     */
    // Registrar acceso (login)
    Route::post('/bitacora', [BitacoraController::class, 'store'])->name('bitacora.store');

    // Registrar salida (logout o cerrar sesión)
    Route::post('/bitacora/salida', [BitacoraController::class, 'salida'])->name('bitacora.salida');

    // Ver bitácora de un usuario
    Route::get('/bitacoras/{user}', [BitacoraController::class, 'index'])->name('bitacora.index');

    Route::get('/api/bitacora_acceso/usuario/{userId}', function ($userId) {
        return BitacoraAcceso::where('user_id', $userId)
            ->orderByDesc('fecha_acceso')
            ->get(['fecha_acceso', 'fecha_salida']);
    });
});

// Importa las rutas de autenticación de Breeze (login, logout, etc.)
require __DIR__.'/auth.php';


