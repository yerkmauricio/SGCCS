<?php

namespace Database\Seeders;

use App\Models\tipo_persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoPersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo_persona = [
            ['nombre' => 'Visitante', 'descripcion' => 'Persona que viene a la instuticion de manera temporal','fecha' => now()],
            ['nombre' => 'Estudiantes', 'descripcion' => 'Persona que viene a la instuticion de manera temporal y estudia en un colegio','fecha' => now()],
            ['nombre' => 'Universitarios', 'descripcion' => 'Persona que viene a la instuticion de manera temporal y estudia en una universidad','fecha' => now()],
            ['nombre' => 'Jefe de Área', 'descripcion' => 'Encargado de supervisar y coordinar las actividades del área.','fecha' => now()],
            ['nombre' => 'Secretaria de Unidad', 'descripcion' => 'Encargada de brindar apoyo administrativo y de secretaría en la unidad.','fecha' => now()],
            ['nombre' => 'Recepcionista', 'descripcion' => 'Encargado de recibir a los visitantes y gestionar las llamadas y correos electrónicos en la unidad.','fecha' => now()],
            ['nombre' => 'Pasante', 'descripcion' => 'Estudiante en prácticas que realiza tareas de apoyo en la unidad.','fecha' => now()],
            ['nombre' => 'Técnico', 'descripcion' => 'Encargado de realizar tareas técnicas y de mantenimiento en la unidad.','fecha' => now()],
            ['nombre' => 'Coordinador de Proyectos', 'descripcion' => 'Responsable de planificar y supervisar la ejecución de los proyectos en la unidad.','fecha' => now()],
            ['nombre' => 'Especialista en Ventas', 'descripcion' => 'Encargado de promover y gestionar las ventas de productos o servicios de la unidad.','fecha' => now()],
            ['nombre' => 'Analista de Datos', 'descripcion' => 'Encargado de analizar y procesar datos para obtener información relevante en la unidad.','fecha' => now()],
            ['nombre' => 'Asistente Administrativo', 'descripcion' => 'Brinda apoyo administrativo y operativo en la unidad.','fecha' => now()],
        ];

        tipo_persona::insert($tipo_persona);

    }
}
