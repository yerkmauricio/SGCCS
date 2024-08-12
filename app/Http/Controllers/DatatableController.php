<?php

namespace App\Http\Controllers;

use App\Models\persona;
use Illuminate\Http\Request;

class DatatableController extends Controller
{
    public function index()
    {
        $personas = persona::select('id','nombre', 'whatsapp', 'institucion')->get();
        //return $persona;
        return datatables()->of($personas)->toJson();
    }
}
