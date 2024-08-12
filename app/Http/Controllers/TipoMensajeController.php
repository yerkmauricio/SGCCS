<?php

namespace App\Http\Controllers;

use App\Models\tipo_mensaje;
use App\Http\Requests\Storetipo_mensajeRequest;
use App\Http\Requests\Updatetipo_mensajeRequest;

class TipoMensajeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:tipo_mensajes.index')->only('index');
        $this->middleware('can:tipo_mensajes.create')->only('create', 'store');
        $this->middleware('can:tipo_mensajes.edit')->only('edit', 'update');
        $this->middleware('can:tipo_mensajes.destroy')->only('destroy');
    }

    public function index()
    {
        $tipo_mensajes = tipo_mensaje::all();
        return view('administrador.tipo_mensajes.index', compact('tipo_mensajes'));
    }


    public function create()
    {
        return view('administrador.tipo_mensajes.create');
    }


    public function store(Storetipo_mensajeRequest $request)
    {
       // dd($request);
        $tipo_mensajes =  tipo_mensaje::create($request->all());

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('tipo_mensajes'); //el nombre de la carpeta public
            $tipo_mensajes->foto = $foto;

        }
        $tipo_mensajes->save();
        return redirect('tipo_mensajes')->with('guardar', 'ok');
    }


    public function show(tipo_mensaje $tipo_mensaje)
    {
    }


    public function edit(tipo_mensaje $tipo_mensaje)
    {
        return view('administrador.tipo_mensajes.edit', compact('tipo_mensaje'));
    }


    public function update(Updatetipo_mensajeRequest $request, tipo_mensaje $tipo_mensaje)
    {

        //dd($request);
        $tipo_mensaje->update($request->all());
         if ($request->hasFile('foto')) {
             $foto = $request->file('foto')->store('tipo_mensajes'); //el nombre de la carpeta public
             $tipo_mensaje->foto = $foto;
        }
        $tipo_mensaje->save();
        return  redirect('tipo_mensajes')->with('editar', 'ok'); //redirecciona a la vista principal
    }


    public function destroy(tipo_mensaje $tipo_mensaje)
    {
        $tipo_mensaje->delete();
        return redirect('tipo_mensajes')->with('eliminar', 'ok');
    }
}
