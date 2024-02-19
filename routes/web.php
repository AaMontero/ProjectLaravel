<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\ClienteController;


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
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', function () {
        return view('dashboard');
    });
    Route::get('/paquetes/{paquete}', function ($paquete) {
        return ('Este es el paquete: ' . $paquete);
    });

    Route::get(
        '/paquetes/{paquete}/edit',
        [PaqueteController::class, 'edit']
    )
        ->name('paquetes.edit');

    //Ruta a listar los paquetes
    Route::get(
        '/paquetes',
        [PaqueteController::class,  'index']
    )
        ->name('paquetes.paquetes');

    //Ruta a agregar un paquete
    Route::post(
        '/paquetes',
        [PaqueteController::class, 'store']
    )
        ->name('paquetes.store');

    //Ruta a actualizar un paquete
    Route::put('paquetes/{paquete}',  [PaqueteController::class, 'update'])
        ->name("paquetes.update");

    // Ruta a eliminar un paquete
    Route::delete('paquetes/{paquete}', [PaqueteController::class, 'destroy'])
        ->name('paquetes.destroy');

    //Ruta para clientes
    Route::get('/clientes',        [ClienteController::class, 'index'])
        ->name('clientes.index'); //Mostrar Clientes
    Route::post('clientes',        [ClienteController::class, 'store'])
        ->name('clientes.store'); //Agregar Cliente

    //Ruta para el calendario
    Route::get('calendar/index', [CalendarController::class, 'index'])->name('calendar.index');
    Route::post('/calendar', [CalendarController::class, 'store'])->name('calendar.store');
    Route::patch('calendar/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
    Route::delete('calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');


    //Rutas para los contratos y clientes
    Route::get('contrato/index',[ContratoController::class, 'index'])->name('contrato.index');
    //Route::post('/contrato/index', [ContratoController::class, 'store'])->name('contrato.store');

});

require __DIR__ . '/auth.php';
