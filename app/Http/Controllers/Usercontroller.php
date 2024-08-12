<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;

class Usercontroller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // Middleware de autenticación para proteger todo el controlador
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.create')->only('create', 'store');
        $this->middleware('can:users.edit')->only('edit', 'update');
        $this->middleware('can:users.destroy')->only('destroy');
    }

    public function index()
    {
        $users = User::all();

        return view('administrador.users.index', compact('users'));
    }


    public function create()
    {
        $roles = Role::all();
        return view('administrador.users.create', compact('roles'));
    }


    public function store(StoreUserRequest $request)
    {
        $request->validate(['role' => 'required|exists:roles,id',]);
        $role = Role::findById($request->role);
        // $user =  user::create($request->all());



        $password = substr($request->name, 0, 2) . substr($request->ci, 0, 9) . substr($request->apellidopaterno, 0, 2);
        $user = new User([
            'name' => $request->name,
            'password' => Hash::make($password), // Aquí estamos hasheando la contraseña
            'email' => $request->email,
            'ci' => $request->ci,
            'apellidopaterno' => $request->apellidopaterno,
            'apellidomaterno' => $request->apellidomaterno,
            'expedito' => $request->expedito,
            'genero' => $request->genero,
            'cargo' => $request->cargo,
            'unidad' => $request->unidad,
            'fnacimiento' => $request->fnacimiento,
            // 'universidad' => $request->universidad,

            // 'localizacion' => $request->localizacion,
            // 'carrera' => $request->carrera,
        ]);

        //dd($password);
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('users'); //el nombre de la carpeta public
            $user->foto = $foto;
        }
        $user->assignRole($role->name);
        $user->save();
        return redirect('users')->with('guardar', 'ok');
    }


    public function show(User $user)
    {

        return view('administrador.users.show ', compact('user'));
    }


    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        $userRole = $user->getRoleNames()->first();

        return view('administrador.users.edit', compact('roles', 'user', 'userRole'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {

        $validated = $request->validated();
        if ($request->rp == 505) {
            $password = substr($user->name, 0, 2) . substr($user->ci, 0, 9) . substr($user->apellidopaterno, 0, 2);
            //dd($user->password);
            $user->password = Hash::make($password);

            $user->save();
            return redirect()->back()->with('restablecer', 'ok');

        }

        $user->update($request->all());

        if ($request->estado == 0) {
            // Asignar la fecha de suspensión como la fecha actual
            $user->fsuspension = now();

            // Obtener el rol "Sin Rol"
            $sinRol = Role::findByName('Sin Role');

            // Quitar todos los roles anteriores y asignar el rol "Sin Rol"
            $user->syncRoles([$sinRol->name]);

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto')->store('users');
                $user->foto = $foto;
            }

            $user->save();

            // Redireccionar al listado de usuarios con un mensaje
            return redirect('users')->with('guardar', 'ok');
        } else {


            // Obtener el nuevo rol seleccionado
            $newRole = Role::findById($request->role);

            // Quitar todos los roles anteriores
            $user->syncRoles([$newRole->name]);

            // Guardar la foto si se proporcionó
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto')->store('users');
                $user->foto = $foto;
            }

            // Guardar los cambios en el usuario
            $user->save();

            // Redireccionar al listado de usuarios con un mensaje
            return redirect('users')->with('guardar', 'ok');
        }
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect('users')->with('eliminar', 'ok');
    }
}
