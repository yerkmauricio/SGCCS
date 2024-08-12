<?php

namespace Database\Seeders;

use App\Models\persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{

    // public function run(): void
    // {
    //     $faker = Faker::create();
    //     $personas = [];
    //     $existingNumbers = [];

    //     for ($i = 0; $i < 66800; $i++) {
    //         $uniqueNumber = $this->generateUniqueNumber($faker, $existingNumbers);

    //         $personas[] = [
    //             'nombre' => $faker->firstName,
    //             'apellidop' => $faker->lastName,
    //             'apellidom' => $faker->lastName,
    //             'genero' => $faker->numberBetween(0, 1),
    //             'whatsapp' => $uniqueNumber,
    //             'tipo_persona_id' => $faker->numberBetween(1, 8),
    //             'categoria' => $faker->randomElement(['universitario','funcionario']),
    //             'institucion' => $faker->randomElement(['UPEA', 'UMSA', 'UPB', 'UCB']),
    //             'unidad' => null,
    //             'cargo' => null,
    //             'carrera' => $faker->randomElement(['ingenieria en sistemas', 'ingenieria civil', 'medicina', 'derecho']),
    //             'sede' => $faker->city,
    //             'fecha' => now()
    //         ];

    //         // Insertar en lotes de 1000 para evitar sobrecargar la memoria
    //         if ($i % 1000 == 0 && $i > 0) {
    //             DB::table('personas')->insert($personas);
    //             $personas = []; // Vaciar el array para el siguiente lote
    //         }
    //     }

    //     // Insertar los registros restantes
    //     if (!empty($personas)) {
    //         DB::table('personas')->insert($personas);
    //     }
    // }

    // private function generateUniqueNumber($faker, &$existingNumbers)
    // {
    //     do {
    //         $number = $faker->numberBetween(53160000000, 69179999999);
    //     } while (in_array($number, $existingNumbers));

    //     $existingNumbers[] = $number;
    //     return $number;
    // }
    public function run()
    {
        $persona = [
            ['nombre' => 'rudy', 'apellidop' => 'mauricio', 'apellidom' => 'montaño','ci' => '8377485','expedito' => 'lp','genero'=> 1 ,'nacionalidad' => 'bolivia','fnacimiento'=>now(),'whatsapp'=>59179112050,'tipo_persona_id'=>2,'categoria'=>'funcionario','institucion'=>'gamea','unidad'=>'sistemas','cargo'=>'pasante','carrera'=>null,'sede'=>null,'fecha' => now()],
            ['nombre' => 'maribel', 'apellidop' => 'vargas', 'apellidom' => 'laura','ci' => '8377485','expedito' => 'lp','genero'=> 0 ,'nacionalidad' => 'bolivia','fnacimiento'=>now(),'whatsapp'=>59169836120,'tipo_persona_id'=>1,'categoria'=>'funcionario','institucion'=>'gamea','unidad'=>'sistemas','cargo'=>'pasante','carrera'=>null,'sede'=>null,'fecha' => now()],
            ['nombre' => 'yerk', 'apellidop' => 'mauricio', 'apellidom' => 'montaño','ci' => '8377485','expedito' => 'lp','genero'=> 1 ,'nacionalidad' => 'bolivia','fnacimiento'=>now(),'whatsapp'=>59165144038,'tipo_persona_id'=>6,'categoria'=>'funcionario','institucion'=>'gamea','unidad'=>'sistemas','cargo'=>'pasante','carrera'=>null,'sede'=>null,'fecha' => now()],
            ['nombre' => 'daysi', 'apellidop' => 'llusco', 'apellidom' => 'candia','ci' => '8377485','expedito' => 'lp','genero'=> 0 ,'nacionalidad' => 'bolivia','fnacimiento'=>now(),'whatsapp'=>59167157486,'tipo_persona_id'=>3,'categoria'=>'funcionario','institucion'=>'upea','unidad'=>null,'cargo'=>null,'carrera'=>'turismo','sede'=>'villa esperanza','fecha' => now()],
            ['nombre' => 'mendel', 'apellidop' => 'maldonado', 'apellidom' => 'nina','ci' => '8377485','expedito' => 'lp','genero'=> 1 ,'nacionalidad' => 'bolivia','fnacimiento'=>now(),'whatsapp'=>59167056203,'tipo_persona_id'=>3,'categoria'=>'funcionario','institucion'=>'upea','unidad'=>null,'cargo'=>null,'carrera'=>'ingenieria en sistemas','sede'=>'villa esperanza','fecha' => now()],
            ['nombre' => 'liz', 'apellidop' => 'layme', 'apellidom' => null,'ci' => '8377485','expedito' => 'lp','genero'=> 0 ,'nacionalidad' => 'bolivia','fnacimiento'=>now(),'whatsapp'=>59175243174,'tipo_persona_id'=>3,'categoria'=>'funcionario','institucion'=>'upea','unidad'=>null,'cargo'=>null,'carrera'=>'turismo','sede'=>'villa esperanza','fecha' => now()],
        ];

        persona::insert($persona);
    }
}
