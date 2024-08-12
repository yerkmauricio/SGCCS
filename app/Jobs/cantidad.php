<?php

namespace App\Jobs;

use App\Models\persona;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class cantidad implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cantidad;
    protected $cantidad_inicio;
    protected $cantidad_fin;
    protected $persona;
    protected $mensaje;
    protected $titulo;
    protected $mensajeencontrado;
    protected $imagenBase64;
    protected $PF;

    public function __construct($cantidad, $cantidad_inicio, $cantidad_fin, $persona,  $mensaje, $titulo, $imagenBase64, $PF)
    {
        $this->cantidad = $cantidad;
        $this->cantidad_inicio = $cantidad_inicio;
        $this->cantidad_fin = $cantidad_fin;
        $this->persona = $persona;
        $this->mensaje = $mensaje;
        $this->titulo = $titulo;
        $this->imagenBase64 = $imagenBase64;
        $this->PF = $PF;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->imagenBase64 == null) {
            $intervalo = rand(3, 5);
            sleep($intervalo);
            Http::post('https://api.ultramsg.com/instance88230/messages/chat', [ //cambiar
                'token' => '4tdg9dsks4bu3712', //cambiar
                'to' => $this->persona->whatsapp,
                // 'body' => strtoupper($this->titulo) . "\n" . ' Estimado ' . strtoupper($this->persona->tipo_persona->nombre) . ' ' . $this->PF,
                'body' => strtoupper($this->titulo) . "\n" . ' ' . $this->PF,
            ]);
        } else {
            $intervalo = rand(3, 5);
            sleep($intervalo);
            Http::post('https://api.ultramsg.com/instance88230/messages/image', [ //cambiar
                'token' => '4tdg9dsks4bu3712', //cambiar
                'to' => $this->persona->whatsapp,
                'image' => $this->imagenBase64, // Contenido de la imagen en base64
                'caption' => strtoupper($this->titulo) . "\n" . ' ' . $this->PF,
            ]);
        }
    }
}
