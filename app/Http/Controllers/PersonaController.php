<?php

namespace App\Http\Controllers;

use App\Models\persona;
use App\Http\Requests\StorepersonaRequest;
use App\Http\Requests\UpdatepersonaRequest;
use App\Models\tipo_persona;
use Elasticsearch\ClientBuilder;

use Elastic\Elasticsearch\ClientBuilder as ElasticsearchClientBuilder;

use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:personas.index')->only('index');
        $this->middleware('can:personas.create')->only('create', 'store');
        $this->middleware('can:personas.edit')->only('edit', 'update');
        $this->middleware('can:personas.destroy')->only('destroy');
        $this->middleware('can:personas.show')->only('show');
    }


    public function index(Request $request)
    {

        if ($request->ajax()) {
            try {
                // Consulta directa a la tabla personas
                $personas = Persona::select('id as idp', 'nombre', 'apellidop', 'apellidom', 'ci', 'whatsapp', 'institucion');

                //8return response()->json(['data' => $personas]); // Devolver los datos en formato JSON
                return DataTables::of($personas)->make(true);
            } catch (\Exception $e) {
                // Manejar errores de consulta a la base de datos
                return response()->json(['error' => 'Error al recuperar los datos de personas'], 500);
            }
        }

        return view('administrador.personas.index');
    }

    public function create()
    {

        $tipo_personas = tipo_persona::pluck('nombre', 'id');
        return view('administrador.personas.create', compact('tipo_personas'));
    }


    public function store(StorepersonaRequest $request)
    {
        // $persona = Persona::create($request->all());

        // $persona->save();
        // return redirect('personas')->with('guardar', 'ok');

        
        // Crear la nueva persona con los datos del request
        $persona = Persona::create($request->except('tipo_persona_ids')); // Excluye el campo tipo_persona_ids para manejarlo separadamente

        // Asociar los tipos de persona seleccionados a la nueva persona
       
        $persona->tipoPersonas()->sync($request->input('tipo_persona_ids', [])); // Sincroniza la relación muchos a muchos
        //dd($request->input('tipo_persona_ids')); // Verifica los IDs que se están enviando

        return redirect('personas')->with('guardar', 'ok');
    }


    public function show(persona $persona)
    {

        return view('administrador.personas.show', compact('persona'));
    }


    public function edit(persona $persona)
    {
        $tipo_personas = tipo_persona::pluck('nombre', 'id');
        return view('administrador.personas.edit', compact('persona', 'tipo_personas'));
    }


    public function update(UpdatepersonaRequest $request, persona $persona)
    {

        $persona->update($request->except('tipo_persona_ids'));

        // Actualizar la relación muchos a muchos con los tipos de personas
        $tipoPersonaIds = $request->input('tipo_persona_ids', []);
        $persona->tipoPersonas()->sync($tipoPersonaIds);
    
        // Redirigir con un mensaje de éxito
        return redirect('/personas')->with('editar', 'ok');
    }


    public function destroy(persona $persona)
    {
        $persona->delete();
        return redirect('personas')->with('eliminar', 'ok');
    }
}
