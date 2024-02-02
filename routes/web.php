<?php

use App\Http\Controllers\ControllerCalendar;
use App\Http\Controllers\ControllerEvents;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaqueteController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Route::post();
//Route::put();
//Route::delete();


//Middleware - Bloque de código que se ejecuta en el medio del enrutamiento

Route::middleware('auth')->group(function () {
    Route::view('/dashboard','dashboard')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/paquetes/{paquete}', function($paquete){
        return ('Este es el paquete: '. $paquete);
    });

    Route::get('/paquetes/{paquete}/edit',
    [PaqueteController::class, 'edit'])
    ->name('paquetes.edit');

    //Ruta a listar los paquetes
    Route::get('/paquetes',
    [PaqueteController::class,  'index'])
    ->name('paquetes.paquetes');

    //Ruta a agregar un paquete
    Route::post('/paquetes',
    [PaqueteController::class , 'store'])
    ->name('paquetes.store');

    //Ruta a actualizar un paquete
    Route::put('paquetes/{paquete}',  [PaqueteController::class, 'update']  )
    ->name("paquetes.update");

    // Ruta a eliminar un paquete
    Route::delete('paquetes/{paquete}',[PaqueteController::class, 'destroy'])
    ->name('paquetes.destroy');

    //Ruta para el calendario
    Route::get('Calendar',[ControllerCalendar::class, 'calendar']);
    Route::get('Calendar/{mes}',[ControllerCalendar::class,'month']);
    Route::get('Events/{form}',[ControllerEvents::class, 'form']);
    Route::post('Events',[ControllerEvents::class,'create'])
    ->name('Events.create');
    Route::get('Calendar',[ControllerEvents::class, 'calendar']);
    Route::get('Calendar/{mes}',[ControllerEvents::class,'month']);


});

require __DIR__.'/auth.php';
