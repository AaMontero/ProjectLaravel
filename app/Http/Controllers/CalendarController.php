<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Eventos;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //
    public function index()
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
        $eventos = Eventos::all();
        $estadoCalendario = "" ;
        foreach($eventos as $evento){
            if( ($evento->estado) === "reservado"){
                $estadoCalendario = "Esta reservado";
            }else{
                $estadoCalendario = $evento->estado;
            }
            $events[] = [
                // 'titular'=> $evento->titular,
                // 'fecha_inicio'=>$evento->fecha_inicio,
                // 'fecha_salida'=>$evento->fecha_salida,
                // 'estado'=>$evento->estado,
                // 'descripcion'=>$evento->descripcion,
                'title' => $evento->title,
                'start' => $evento->start_date,
                'end' => $evento->start_date
            ];
        }

        return view ('calendar.calendar',['event' => $events]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'author' => 'required|string',
            'note' => 'required|string',

        ]);

        $eventos = Eventos::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'author' => $request->author,
            'note' => $request->note,
            'user_id' => auth()->id()

        ]);
        return response()->json($eventos);
    }
}
