<?php

namespace Database\Seeders;

use App\Models\tipo_mensaje;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoMensajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos_mensaje = [
            ['nombre' => 'Feliz Día de la Madre', 'descripcion' => '¡Felicidades a todas las madre alteñas por parte del GAMEA!', 'foto' => 'tipo_mensajes/DhAiRH2ZF0wr3ob9g0LhfNlt2N7My8jtmFyoCzgY.jpg','fecha' => now()],
            ['nombre' => 'Feliz Día del Padre', 'descripcion' => '¡Felicidades a todos los padres alteños por parte del GAMEA!', 'foto' => 'tipo_mensajes/AqcQj1UkrwstQseAW3WE5gobGy3DMGjuYrtojEOg.jpg','fecha' => now()],
            ['nombre' => 'Feliz Día del Maestro', 'descripcion' => '¡Felicidades a todos los maestros alteños por parte del GAMEA!', 'foto' =>'tipo_mensajes/iQuccf1tFLELbPFRaABzK7prlJUsKVXwRup3OaJn.jpg','fecha' => now()],
            ['nombre' => 'Feliz Cumpleaños', 'descripcion' => '¡Que tengas un excelente día por parte del GAMEA!', 'foto' =>'tipo_mensajes/q6ay2OGWYcjpYHsItPl44BB5IHTp9a69FEqjIfwD.jpg','fecha' => now()],
            ['nombre' => 'Feliz Día del Niño', 'descripcion' => '¡Felicidades a todos los niños alteños por parte del GAMEA!', 'foto' =>'tipo_mensajes/gQC1eGxgLeWKSytXU79E5YpM81P6fqyrmmcbpR53.jpg','fecha' => now() ],
            ['nombre' => 'Feliz Día del Estudiante', 'descripcion' => '¡Felicidades a todos los estudiantes alteños por parte del GAMEA!', 'foto' =>'tipo_mensajes/mxahfIMk7VOLSbFU53KQUsq9eJyI6i7CAn6YSTzf.jpg','fecha' => now()],
            ['nombre' => 'Reunión de Equipo', 'descripcion' => 'Todos los colaboradores deben asistir a la reunión.','foto'=>null,'fecha' => now()],
            ['nombre' => 'Junta de Coordinación', 'descripcion' => 'Se convoca a los coordinadores a la junta de coordinación.','foto'=>null,'fecha' => now()],
            ['nombre' => 'Reunión de Ventas', 'descripcion' => 'Se convoca a todos los vendedores a la reunión de ventas.','foto'=>null,'fecha' => now()],
            ['nombre' => 'Reunión de Planificación', 'descripcion' => 'Reunión para planificar las actividades del próximo mes.','foto'=>null,'fecha' => now()],
            ['nombre' => 'Reunión de Proyectos', 'descripcion' => 'Reunión para discutir el progreso de los proyectos en curso.','foto'=>null,'fecha' => now()],
        ];
        tipo_mensaje::insert($tipos_mensaje);
    }
}
