<?php

namespace App\Http\Controllers;

use App\Models\tipo_caso;
use App\Http\Requests\Storetipo_casoRequest;
use App\Http\Requests\Updatetipo_casoRequest;

class TipoCasoController extends Controller
{
     
    public function index()
    {
        $tipo_casos = tipo_caso::all(); 
        return view('administrador.tipo_casos.index', compact('tipo_casos'));
    }
    public function create()
    {
        return view('administrador.tipo_casos.create');
    }

     
    public function store(Storetipo_casoRequest $request)
    {
        $tipo_casos =  tipo_caso::create($request->all());
        $tipo_casos->save();
        return redirect('tipo_casos')->with('guardar', 'ok');
    }

     
    public function show(tipo_caso $tipo_caso)
    {
        
    }

     
    public function edit(tipo_caso $tipo_caso)
    {
        return view('administrador.tipo_casos.edit', compact('tipo_caso'));
    }

     
    public function update(Updatetipo_casoRequest $request, tipo_caso $tipo_caso)
    {
        $tipo_caso->update($request->all());

        $tipo_caso->save();
        return  redirect('tipo_casos')->with('editar', 'ok'); //redirecciona a la vista principal
    }

   
    public function destroy(tipo_caso $tipo_caso)
    {
        $tipo_caso->delete();
        return redirect('tipo_casos')->with('eliminar', 'ok');
    }
}
