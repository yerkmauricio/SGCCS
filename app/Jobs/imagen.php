<?php

namespace App\Jobs;

use FFI;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stomp\Client;
use Stomp\Network\Connection;
use Stomp\SimpleStomp;

class imagen implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $persona;
    protected $mensaje;
    protected $titulo;
    protected $mensajeencontrado;
    protected $imagenBase64;
    protected $PF;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($persona, $mensaje, $titulo, $imagenBase64, $PF)
    {
        $this->persona = $persona;
        $this->mensaje = $mensaje;
        $this->titulo = $titulo;
        $this->imagenBase64 = $imagenBase64;
        $this->PF = $PF;
        //dd($imagenBase64);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    { $broker = 'tcp://64.225.54.113:61613'; // Asegúrate de usar el puerto correcto para STOMP
        $username = 'admin';
        $password = 'elalto2024';

        $messageData = [
            'token' => '4tdg9dsks4bu3712', // Asegúrate de usar el token correcto
            'to' => $this->persona->whatsapp,
            'image' => $this->imagenBase64,
            'caption' => strtoupper($this->titulo) . "\n" . ' ' . $this->PF,
        ];
        $message = json_encode($messageData);

        try {
            $connection = new Connection($broker);
            $stomp = new Client($connection);
            $stomp->setLogin($username, $password);
            $stomp->connect();

            $stomp->send('/queue/enviar_imagen', $message, ['persistent' => 'true']);

            $stomp->disconnect();
        } catch (\Exception $e) {
        
        }
    }
}
