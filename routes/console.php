<?php

use App\Models\Persona;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log; // Importa la clase Log

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
// Tarea para enviar mensajes de confirmación
Schedule::call(function () {
    sendConfirmationMessage();
})->everyTenMinutes();

function sendConfirmationMessage()
{
    $today = Carbon::today()->toDateString();
    $personas = Persona::whereDate('fecha', $today)->get();

    foreach ($personas as $persona) {
        $response = Http::post('https://api.ultramsg.com/instance84201/messages/chat', [
            'token' => 'kxkmcbqo9du40j2b',
            'to' => $persona->whatsapp,
            'body' => "Muchas gracias por visitar nuestras instalaciones, espero que su visita sea lo más agradable posible. Saludos, el equipo del GAMEA."
        ]);

        Log::info('Mensaje enviado a: ' . $persona->whatsapp);
    }

}
