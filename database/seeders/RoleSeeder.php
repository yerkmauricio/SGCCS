<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name'=>'administrador']);
        $role2 = Role::create(['name'=>'usuario']);
        $role3 = Role::create(['name'=>'sin role']);

        Permission::create(['name'=>'home'])->assignRole([$role1,$role2]);

        Permission::create(['name'=>'users.create','description'=>'Crear usuarios'])->assignRole([$role1]);
        Permission::create(['name'=>'users.index','description'=>'Mostrar usuarios'])->assignRole([$role1]);
        Permission::create(['name'=>'users.edit','description'=>'Editar usuarios'])->assignRole([$role1]);
        Permission::create(['name'=>'users.show','description'=>'Ver usuarios'])->assignRole([$role1]);
        Permission::create(['name'=>'users.destroy','description'=>'Eliminar usuarios'])->assignRole([$role1]);

        Permission::create(['name'=>'personas.create','description'=>'Crear personas'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'personas.index','description'=>'Mostrar personas'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'personas.edit','description'=>'Editar personas'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'personas.show','description'=>'Ver personas'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'personas.destroy','description'=>'Eliminar personas'])->assignRole([$role1,$role2]);

        Permission::create(['name'=>'roles.create','description'=>'Crear roles'])->assignRole([$role1 ]);
        Permission::create(['name'=>'roles.index','description'=>'Mostar roles'])->assignRole([$role1 ]);
        Permission::create(['name'=>'roles.edit','description'=>'Editar roles'])->assignRole([$role1 ]);
        Permission::create(['name'=>'roles.show','description'=>'Ver perfil'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'roles.destroy','description'=>'Eliminar roles'])->assignRole([$role1 ]);

        // cambio
        Permission::create(['name'=>'tipo_mensajes.create','description'=>'Crear tipo de mensaje'])->assignRole([$role1]);
        Permission::create(['name'=>'tipo_mensajes.index','description'=>'Mostrar tipo de mensaje'])->assignRole([$role1]);
        Permission::create(['name'=>'tipo_mensajes.edit','description'=>'Editar tipo de mensaje'])->assignRole([$role1]);
        Permission::create(['name'=>'tipo_mensajes.destroy','description'=>'Eliminar tipo de mensaje'])->assignRole([$role1]);

        Permission::create(['name'=>'tipo_personas.create','description'=>'Crear tipo de persona'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'tipo_personas.index','description'=>'Mostrar tipo de persona'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'tipo_personas.edit','description'=>'Editar tipo de persona'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'tipo_personas.destroy','description'=>'Eliminar tipo de persona'])->assignRole([$role1,$role2]);

        Permission::create(['name'=>'mensajes.create','description'=>'Enviar mensajes'])->assignRole([$role1 ]);
        Permission::create(['name'=>'mensajes.index','description'=>'Mostrar estadisticas'])->assignRole([$role1 ]);

    }
}
