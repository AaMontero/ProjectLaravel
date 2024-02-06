<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //
    public function calendario()
    {
        $events = array();
        $eventos = Evento::all();
        foreach($eventos as $eventos){
            $events[] = [
                'titular'=> $eventos->titular,
                'fecha_inicio'=>$eventos->fecha_inicio,
                'fecha_salida'=>$eventos->fecha_salida,
                'estado'=>$eventos->estado,
                'descripcion'=>$eventos->descripcion,

            ];
        }

        return view ('calendar.calendar',['event' => $events]);
    }
}
