<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreroleRequest;
use App\Http\Requests\UpdateroleRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:roles.index')->only('index');
        $this->middleware('can:roles.create')->only('create', 'store');
        $this->middleware('can:roles.edit')->only('edit', 'update');
        $this->middleware('can:roles.destroy')->only('destroy');
        $this->middleware('can:roles.show')->only('show');

    }

    public function index()
    {
        $roles = Role::all();

        return view('administrador.roles.index', compact('roles'));
    }


    public function create()
    {
        $permissions = Permission::all();
        return view('administrador.roles.create', compact('permissions'));
    }


    public function store(StoreroleRequest $request)
    {
        // Crear el nuevo rol con los datos del formulario
        $role = Role::create($request->all());

        // Obtener los IDs de los permisos seleccionados del formulario
        $permissionIds = $request->input('permissions', []);

        // Obtener los nombres de los permisos correspondientes a los IDs
        $permissions = Permission::whereIn('id', $permissionIds)->pluck('name')->toArray();

        // Asignar los permisos al nuevo rol
        $role->syncPermissions($permissions);

        // return redirect()->route('roles.index')
        //     ->with('success', 'Role creado con éxito.');
        return redirect('roles')->with('guardar', 'ok');
    }


    public function show(User $user)
    {
        $user = auth()->user();

        return view('administrador.roles.show ', compact('user'));
    }


    public function edit(role $role)
    {
        $permissions = Permission::all();
        return view('administrador.roles.edit', compact('permissions', 'role'));
    }


    public function update(UpdateroleRequest $request, role $role)
    {
        // Actualizar los datos del rol con los datos del formulario
        $role->update($request->all());

        // Obtener los IDs de los permisos seleccionados del formulario
        $permissionIds = $request->input('permissions', []);

        // Obtener los nombres de los permisos correspondientes a los IDs
        $permissions = Permission::whereIn('id', $permissionIds)->pluck('name')->toArray();

        // Sincronizar los permisos del rol con los permisos seleccionados
        $role->syncPermissions($permissions);

        return redirect()->route('roles.edit', $role)->with('success', 'El rol se actualizó correctamente.');

    }


    public function destroy(role $role)
    {
        $role->delete();
        return redirect('roles')->with('eliminar', 'ok');
    }
}
