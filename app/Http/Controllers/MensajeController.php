<?php

namespace App\Http\Controllers;

use App\Models\mensaje;
use App\Http\Requests\StoremensajeRequest;
use App\Http\Requests\UpdatemensajeRequest;
use App\Models\persona;
use App\Models\tipo_mensaje;
use App\Models\tipo_persona;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendMessageJob;
use App\Jobs\cantidad;
use App\Jobs\imagen;
//use Illuminate\Http\UploadedFile;

use Illuminate\Http\Request;

class MensajeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:mensajes.index')->only('index');
        $this->middleware('can:mensajes.create')->only('create', 'store');
    }
    public function index()
    {
        $activeUsers = User::where('estado', 1)->count();
        $inactiveUsers = User::where('estado', 0)->count();

        $personCounts = DB::table('personas')
            ->join('tipo_personas', 'personas.tipo_persona_id', '=', 'tipo_personas.id')
            ->select('tipo_personas.nombre as tipo_persona', DB::raw('count(personas.id) as count'))
            ->groupBy('tipo_personas.nombre')
            ->get();

        // Separar los nombres de los tipos de personas y sus respectivas cantidades
        $labels = $personCounts->pluck('tipo_persona');
        $counts = $personCounts->pluck('count');
        $mensajes = mensaje::all();



        $users = User::all();

        // Crear un array para almacenar los datos de la gráfica
        $data = [];

        // Iterar sobre cada usuario
        foreach ($users as $user) {
            // Obtener la cantidad de mensajes enviados por el usuario
            $messageCount = Mensaje::where('user_id', $user->id)->count();

            // Agregar los datos del usuario a la matriz de datos
            $data[] = [
                'name' => $user->name . ' ' . $user->apellidopaterno,
                'messages_sent' => $messageCount
            ];
        }

        // Convertir los datos a formato JSON para la gráfica
        $jsonData = json_encode($data);
        return view('administrador.mensajes.index', compact('mensajes', 'activeUsers', 'inactiveUsers', 'labels', 'counts',  'jsonData'));
    }


    public function create()
    {
        // $tipo_mensajes = tipo_mensaje::pluck('nombre', 'id');
        $tipo_mensajes = tipo_mensaje::all();
        // $tipo_personas = tipo_persona::all();
        $tipo_personas = tipo_persona::where('estado', 1)->get();
        // dd($tipo_personas);
        return view('administrador.mensajes.create', compact('tipo_mensajes', 'tipo_personas'));
    }

    public function store(StoremensajeRequest $request)
    {
        //dd($request);

        ini_set('max_execution_time', 300);
        $imagenBase64 = null;
        // $personas = Persona::whereIn('tipo_persona_id', $request->input('tipo_persona_id'))->get();
        $tipoPersonaIds = $request->input('tipo_persona_id', []);
        $personas = Persona::whereHas('tipoPersonas', function ($query) use ($tipoPersonaIds) {
            // Calificar la columna 'id' con el nombre de la tabla 'tipo_personas'
            $query->whereIn('tipo_personas.id', $tipoPersonaIds);
        })->distinct()->get();
        //dd($personas);

        $user_id = auth()->id();


        if ($request->nombre == null) {

            $mensajeencontrado = tipo_mensaje::find($request->tipo_mensaje_id);
            $titulo = $mensajeencontrado->nombre;
            $mensaje = $mensajeencontrado->descripcion;

            if ($mensajeencontrado->foto != null) {
                $url =  Storage::path($mensajeencontrado->foto);
                $imagenBase64 = base64_encode(file_get_contents($url));
            }
        } else {
            $titulo = $request->nombre;
            $mensaje = $request->descripcion;

            if ($request->hasFile('foto')) {
                $tipo_mensajes =  tipo_mensaje::create($request->all());
                $foto = $request->file('foto')->store('tipo_mensajes'); //el nombre de la carpeta public
                $tipo_mensajes->foto = $foto;
                $tipo_mensajes->save();
                $id = $tipo_mensajes->id;
                $mensajeencontrado = tipo_mensaje::find($id);
                $titulo = $mensajeencontrado->nombre;
                $mensaje = $mensajeencontrado->descripcion;
                $url =  Storage::path($mensajeencontrado->foto);
                $imagenBase64 = base64_encode(file_get_contents($url));
            }
        }

        $PF = $this->formatearMensaje($titulo, $mensaje);
        
        if ($request->cantidad != null) {
            $cantidad = $request->cantidad;
            $cantidad_inicio = $request->cantidad_inicio;
            $cantidad_fin = $request->cantidad_fin;
            $personas = Persona::whereBetween('id', [$cantidad_inicio, $cantidad_fin])->get();
            foreach ($personas as $persona) {
                cantidad::dispatch($cantidad, $cantidad_inicio, $cantidad_fin, $persona, $mensaje, $titulo, $imagenBase64, $PF);
            }
            
            return redirect()->back()->with('editar', 'ok');
        } else {
            // Despachar cada mensaje a la cola

            if ($imagenBase64 == null) {
                foreach ($personas as $persona) {

                    SendMessageJob::dispatch($persona, $mensaje, $titulo, $PF);
                }
            } else {
                foreach ($personas as $persona) {

                    imagen::dispatch($persona, $mensaje, $titulo, $imagenBase64, $PF); 
                }
            }
        }
        return redirect()->back()->with('editar', 'ok');
    }
    public function sendMessage()
    {
        // Dirección y puerto del broker ActiveMQ
        $host = '159.203.64.92';
        $port = 61613; // Puerto correcto para STOMP

        // Credenciales de autenticación
        $username = 'tu_usuario'; // Reemplaza con tu usuario
        $password = 'tu_contraseña'; // Reemplaza con tu contraseña

        // Mensaje JSON que deseas enviar
        $messageData = [
            'to' => '+59179112050',
            'body' => 'prueba2',
            'token' => '6e9eoug3dnc7z3el'
        ];
        $message = json_encode($messageData);

        // Crear una conexión al broker
        $socket = @fsockopen($host, $port, $errno, $errstr, 30);

        if (!$socket) {
            return response()->json([
                'success' => false,
                'message' => "Error al conectar: $errstr ($errno)"
            ], 500);
        }

        // Enviar solicitud de conexión STOMP con autenticación
        $connect = "CONNECT\n";
        $connect .= "login:$username\n";
        $connect .= "passcode:$password\n";
        $connect .= "accept-version:1.2\n";
        $connect .= "\n\0";

        // Enviar la solicitud de conexión
        fwrite($socket, $connect);

        // Leer la respuesta del broker para confirmar la conexión
        $response = '';
        while (!feof($socket)) {
            $line = fgets($socket, 128);
            $response .= $line;
            if (strpos($line, "\0") !== false) {
                break;
            }
        }

        if (strpos($response, 'CONNECTED') === false) {
            fclose($socket);
            return response()->json([
                'success' => false,
                'message' => "Error al conectar: $response"
            ], 500);
        }

        // Formatear el mensaje STOMP
        $stompMessage = "SEND\n";
        $stompMessage .= "destination:/queue/test\n";
        $stompMessage .= "content-length:" . strlen($message) . "\n";
        $stompMessage .= "\n";
        $stompMessage .= $message;
        $stompMessage .= "\0";

        // Enviar el mensaje
        fwrite($socket, $stompMessage);

        // Leer la respuesta del broker (opcional)
        $response = '';
        while (!feof($socket)) {
            $line = fgets($socket, 128);
            $response .= $line;
            if (strpos($response, "\0") !== false) {
                break;
            }
        }

        // Cerrar la conexión
        fclose($socket);

        return response()->json([
            'success' => true,
            'message' => "Mensaje enviado y respuesta del broker recibida: $response"
        ]);
    }

    private function formatearMensaje($request, $mensaje)
    {
        $a = "*"; // Negrita en WhatsApp
        $b = "\n"; // Salto de línea en WhatsApp
        $c = "-"; // Guion para listas no ordenadas

        $html = $mensaje;
        $html = str_replace('&nbsp;', ' ', $html);

        // Reemplazar <br> con saltos de línea
        $PF = preg_replace('/<br\s*\/?>/i', $b, $html);

        // Reemplazar </p> con salto de línea
        $PF = preg_replace('/<\/p>/', $b, $PF);

        // Reemplazar <b> y </b> con asteriscos
        $PF = preg_replace('/<b>(.*?)<\/b>/', $a . '$1' . $a, $PF);

        // Reemplazar <strong> y </strong> con asteriscos
        $PF = preg_replace('/<strong>(.*?)<\/strong>/', $a . '$1' . $a, $PF);

        // Reemplazar <ul> y </ul> con saltos de línea
        $PF = preg_replace('/<ul>/', $b, $PF);
        $PF = preg_replace('/<\/ul>/', $b, $PF);

        // Reemplazar <ol> y </ol> con saltos de línea y usar un contador para los elementos de la lista ordenada
        $PF = preg_replace_callback('/<ol>(.*?)<\/ol>/s', function ($matches) use ($b) {
            $listItems = preg_replace('/<li>/', '', $matches[1]);
            $listItems = preg_replace('/<\/li>/', '', $listItems);
            $items = explode("\n", trim($listItems));
            $result = '';
            foreach ($items as $index => $item) {
                if (!empty($item)) {
                    $result .= ($index + 1) . '. ' . trim($item) . $b;
                }
            }
            return $result;
        }, $PF);

        // Reemplazar <li> con guiones y saltos de línea
        $PF = preg_replace('/<li>/', $c . ' ', $PF);
        $PF = preg_replace('/<\/li>/', $b, $PF);

        // Reemplazar <a> con links
        $PF = preg_replace('/<a href="(.*?)".*?>(.*?)<\/a>/', '$2 $1', $PF);

        // Eliminar todas las demás etiquetas HTML
        return strip_tags($PF);
    }


    public function show(mensaje $mensaje)
    {
        return view('administrador.mensajes.show', compact('mensaje'));
    }


    public function edit(mensaje $mensaje)
    {
    }


    public function update(UpdatemensajeRequest $request, mensaje $mensaje)
    {
    }


    public function destroy(mensaje $mensaje)
    {
    }
}
