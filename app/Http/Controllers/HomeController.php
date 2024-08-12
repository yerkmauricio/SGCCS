<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $activeUsers = User::where('estado', 1)->count();
        $inactiveUsers = User::where('estado', 0)->count();

        $personCounts = DB::table('personas')
            ->join('tipo_personas', 'personas.tipo_persona_id', '=', 'tipo_personas.id')
            ->select('tipo_personas.nombre as tipo_persona', DB::raw('count(personas.id) as count'))
            ->groupBy('tipo_personas.nombre')
            ->get();

        // Separar los nombres de los tipos de personas y sus respectivas cantidades
        $labels = $personCounts->pluck('tipo_persona');
        $counts = $personCounts->pluck('count');

        return view('home', compact('activeUsers', 'inactiveUsers', 'labels', 'counts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Obtener el usuario
        $user = auth()->user();

        // Verificar la contraseña anterior
        if (!Hash::check($request->current_password, $user->password)) {
            # code...// Verificar si la nueva contraseña es igual a la confirmación
            if ($request->password !== $request->password_confirmation) {
                // Si las contraseñas no coinciden, mostrar mensaje de error
                return redirect()->route('home')->with('error', 'ok');
            } else {
                # code...// Actualizar la contraseña
                $user->password = Hash::make($request->password);
                $user->save();

                // Redireccionar con un mensaje de éxito
                return redirect()->route('home')->with('editar', 'ok');
            }
        } else {
            // Si la contraseña anterior no coincide, mostrar mensaje de error

            return redirect()->route('home')->with('guardar', 'ok');
        }

        // if (condition) {
        //     # code...
        // } else {
        //     # code...
        // }

    }
}
