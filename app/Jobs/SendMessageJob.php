<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\Mensaje;
use Illuminate\Support\Facades\Storage;
use Stomp\Client;
use Stomp\Network\Connection;

class SendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $persona;
    protected $mensaje;
    protected $titulo;
    protected $PF;



    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($persona, $mensaje, $titulo, $PF)
    {
        $this->persona = $persona;
        $this->mensaje = $mensaje;
        $this->titulo = $titulo;
        $this->PF = $PF;
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        // if ($this->imagenBase64 == null) {
        //     $intervalo = rand(5, 10);
        //     sleep($intervalo);
        //     Http::post('https://api.ultramsg.com/instance87158/messages/chat', [ //cambiar
        //         'token' => '8ixtbk4mz805c7j6', //cambiar
        //         'to' => $this->persona->whatsapp,
        //         'body' => strtoupper($this->titulo) . "\n" . ' Estimado ' . strtoupper($this->persona->tipo_persona->nombre) . ' ' . $this->PF,
        //     ]);
        // } else {
        //     $intervalo = rand(5, 10);
        //     sleep($intervalo);
        //     Http::post('https://api.ultramsg.com/instance87158/messages/image', [ //cambiar
        //         'token' => '8ixtbk4mz805c7j6', //cambiar
        //         'to' => $this->persona->whatsapp,
        //         'image' => $this->imagenBase64, // Contenido de la imagen en base64
        //         'caption' => strtoupper($this->titulo) . "\n" . ' Estimado ' . strtoupper($this->persona->tipo_persona->nombre) . ' ' . $this->PF,
        //     ]);
        // }

    //     //   // $mensaje->save();
    //    $host = '64.225.54.113';
    //    $port = 61613; // Puerto correcto para STOMP

    //    // Credenciales de autenticación
    //    $username = 'admin'; // Reemplaza con tu usuario
    //    $password = 'elalto2024'; // Reemplaza con tu contraseña

    //    // Mensaje JSON que deseas enviar
    //    $messageData = [
    //        'to' =>   $this->persona->whatsapp,
    //        'body' =>  strtoupper($this->titulo) . "\n"  . ' ' . $this->PF,
    //        'token' =>  '4tdg9dsks4bu3712'
    //    ];
    //    $message = json_encode($messageData);

    //    // Crear una conexión al broker
    //    $socket = @fsockopen($host, $port, $errno, $errstr, 30);

    // //    if (!$socket) {
    // //        return response()->json([
    // //            'success' => false,
    // //            'message' => "Error al conectar: $errstr ($errno)"
    // //        ], 500);
    // //    }

    //    // Enviar solicitud de conexión STOMP con autenticación
    //    $connect = "CONNECT\n";
    //    $connect .= "login:$username\n";
    //    $connect .= "passcode:$password\n";
    //    $connect .= "accept-version:1.2\n";
    //    $connect .= "\n\0";

    //    // Enviar la solicitud de conexión
    //    fwrite($socket, $connect);

    //    // Leer la respuesta del broker para confirmar la conexión
    // //    $response = '';
    // //    while (!feof($socket)) {
    // //        $line = fgets($socket, 128);
    // //        $response .= $line;
    // //        if (strpos($line, "\0") !== false) {
    // //            break;
    // //        }
    // //    }

    // //    if (strpos($response, 'CONNECTED') === false) {
    // //        fclose($socket);
    // //        return response()->json([
    // //            'success' => false,
    // //            'message' => "Error al conectar: $response"
    // //        ], 500);
    // //    }

    //    // Formatear el mensaje STOMP
    //    $stompMessage = "SEND\n";
    //    $stompMessage .= "destination:/queue/universitario\n";
    //    $stompMessage .= "content-length:" . strlen($message) . "\n";
    //    $stompMessage .= "\n";
    //    $stompMessage .= $message;
    //    $stompMessage .= "\0";

    //    // Enviar el mensaje
    //    fwrite($socket, $stompMessage);

    // //    // Leer la respuesta del broker (opcional)
    // //    $response = '';
    // //    while (!feof($socket)) {
    // //        $line = fgets($socket, 128);
    // //        $response .= $line;
    // //        if (strpos($response, "\0") !== false) {
    // //                 break;
    // //            }
    // //         }

    // //     //   // Cerrar la conexión
    // //        fclose($socket);

    // //         return response()->json([
    // //            'success' => true,
    // //            'message' => "Mensaje enviado y respuesta del broker recibida: $response"
    // //       ]);


    //     //  $stomp = new Client(new Connection(config('services.activemq.host'), 61613));
    //     //  $stomp->setLogin(config('services.activemq.username'), config('services.activemq.password'));
    //     //  $stomp->connect();

    //     // // $message = [
    //     // //     'persona' => $this->persona,
    //     // //     'mensaje' => $this->mensaje,
    //     // //     'titulo' => $this->titulo,
    //     // //     'imagenBase64' => $this->imagenBase64,
    //     // //     'user_id' => $this->user_id,
    //     // //     'PF' => $this->PF,
    //     // // ];
    // //     $message = [
    // //         'to' =>   $this->persona->whatsapp,
    // //         'body' => strtoupper($this->titulo) . "\n" . ' Estimado ' . strtoupper($this->persona->tipo_persona->nombre) . ' ' . $this->PF,
    // //          'token' =>  '8ixtbk4mz805c7j6'
    // //      ];
    // //    $message = json_encode($messageData);


    // //      $stomp->send('/queue/test', json_encode($message));

    // //      $stomp->disconnect();
    $broker = 'tcp://64.225.54.113:61613'; // Asegúrate de usar el puerto correcto para STOMP
    $username = 'admin';
    $password = 'elalto2024';

    $messageData = [
        'to' =>   $this->persona->whatsapp,
           'body' =>  strtoupper($this->titulo) . "\n"  . ' ' . $this->PF,
           'token' =>  '4tdg9dsks4bu3712'
    ];
    $message = json_encode($messageData);

    try {
        $connection = new Connection($broker);
        $stomp = new Client($connection);
        $stomp->setLogin($username, $password);
        $stomp->connect();

        $stomp->send('/queue/universitario', $message, ['persistent' => 'true']);

        $stomp->disconnect();
    } catch (\Exception $e) {
    
    }
    }
}
