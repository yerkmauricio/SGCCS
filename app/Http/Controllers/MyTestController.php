<?php

namespace App\Http\Controllers;

use App\Models\persona;
use Illuminate\Http\Request;

use App\Models\User;

//use DataTables;

class MyTestController extends Controller
{
    /**
     //handle yajra datatable views and data
     */
    public function dataTableLogic(Request $request)
    {
        //dd($request);
        if ($request->ajax()) {
            $users = persona::select('*');
            return datatables()->of($users)
                ->make(true);
            // dd($users);
        }

        return view('y-dataTables');
    }
}
