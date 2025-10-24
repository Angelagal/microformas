<?php

namespace App\Http\Controllers;

use App\Models\BitacoraAcceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BitacoraController extends Controller
{
    /**
     * Mostrar bitácoras de un usuario
     */
    public function index($userId)
    {
        // Solo permitir que el usuario vea su propia bitácora
        if (Auth::id() != $userId) {
            return response()->json(['error' => 'Acceso no autorizado'], 403);
        }

        return BitacoraAcceso::where('user_id', $userId)
                              ->orderBy('fecha_acceso', 'desc')
                              ->get();
    }

    /**
     * Registrar acceso (login)
     */
    public function store(Request $request)
    {
        $user = Auth::user(); // Usuario autenticado

        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }

        $bitacora = BitacoraAcceso::create([
            'user_id' => $user->id,
            'fecha_acceso' => now(),
        ]);

        return response()->json($bitacora);
    }

    /**
     * Registrar salida (logout)
     */
    public function salida(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }

        $bitacora = BitacoraAcceso::where('user_id', $user->id)
                                   ->whereNull('fecha_salida')
                                   ->latest('fecha_acceso')
                                   ->first();

        if ($bitacora) {
            $bitacora->fecha_salida = now();
            $bitacora->save();
        }

        return response()->json($bitacora);
    }
}
