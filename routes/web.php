<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TipoMensajeController;
use App\Http\Controllers\TipoPersonaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/personas', [PersonaController::class, 'index'])->name('personas.index');
Route::resource('/personas',PersonaController::class) ;
Route::resource('/mensajes',MensajeController::class);
Route::resource('/tipo_mensajes',TipoMensajeController::class);
Route::resource('/tipo_personas',TipoPersonaController::class);

Route::resource('users',Usercontroller::class)->names('admin.users') ;

Route::resource('/roles',RoleController::class) ;


Auth::routes();


Route::resource('/homes',HomeController::class) ;


// utilizando active MQ
// use App\Http\Controllers\ActiveMQController;

// Route::post('/send-message', [ActiveMQController::class, 'sendMessage']);
// Route::get('/receive-message/{destination}', [ActiveMQController::class, 'receiveMessage']);

