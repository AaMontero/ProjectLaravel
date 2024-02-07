<?php

namespace App\Http\Controllers;

use App\Models\Evento;

class CalendarController extends Controller
{
    //
    public function calendario()
    {
        // $eventosManual = [
        //     [
        //         'title' => 'event1',
        //         'start' => '2010-01-01'
        //     ],
        //     [
        //         'title' => 'Reservado',
        //         'start' => '2024-02-07',
        //         'end' => '2024-02-15'
        //     ],
        //     [
        //         'title' => 'Reservado',
        //         'start' => '2024-02-07',
        //         'end' => '2024-02-08'
        //     ],
        // ];
        $events = array();
        $eventos = Evento::all();
        $estadoCalendario = "" ; 
        foreach($eventos as $evento){
            if( ($evento->estado) === "reservado"){
                $estadoCalendario = "Esta reservado"; 
            }
            $events[] = [
                // 'titular'=> $evento->titular,
                // 'fecha_inicio'=>$evento->fecha_inicio,
                // 'fecha_salida'=>$evento->fecha_salida,
                // 'estado'=>$evento->estado,
                // 'descripcion'=>$evento->descripcion,
                'title' => $estadoCalendario,
                'start' => $evento->fecha_inicio,
                'end' => $evento->fecha_salida
            ];
        }

        return view ('calendar.calendar',['event' => $events]);
    }
}
