<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' =>'rudy',
            'email' =>'rudy@gmail.com',
            'password' => '123456789',
            'apellidopaterno' => 'mauricio',
            'apellidomaterno' => 'montaño',
            'ci' => '123456789',
            'expedito' => 'LP', // Ejemplo
            'estado' => true,
            'foto' => 'users/1yB1QSSvSc1HK3kYRDH6Fjt1Lejnrjcfqp9AVHWX.jpg', // Ejemplo

            'genero' => true, // Ejemplo
            'cargo' => 'Administrador', // Ejemplo
            'unidad' => 'Administración', // Ejemplo
            'fnacimiento' => '1999-11-22',
            'finicio' => '2024-04-30',
            'fsuspension' => null, // Ejemplo
            // 'universidad' => 'UPEA',
            // 'localizacion' => 'san sebatian',
            // 'carrera' => 'ingenieria en sistemas'
        ])->assignRole('administrador');

        User::create([
            'name' =>'juan',
            'email' =>'juan@gmail.com',
            'password' => bcrypt('123456789'),
            'apellidopaterno' => 'perez',
            'apellidomaterno' => 'perez',
            'ci' => '123456786',
            'expedito' => 'LP', // Ejemplo
            'estado' => true,
            'foto' => 'users/yCPpcKEr53QpJQXeDrrGUYb7kQBbRySONBeCFOOI.jpg', // Ejemplo

            'genero' => true, // Ejemplo
            'cargo' => 'Administrador', // Ejemplo
            'unidad' => 'Administración', // Ejemplo
            'fnacimiento' => '1999-11-22',
            'finicio' => '2024-04-30',
            'fsuspension' => null, // Ejemplo
            // 'universidad' => 'UPEA',
            // 'localizacion' => 'san sebatian',
            // 'carrera' => 'ingenieria en sistemas'
        ])->assignRole('usuario');


       //user::factory(9)->create();
    }
}
