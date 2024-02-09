<?php

namespace App\Http\Controllers;


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
                'id' => $evento->id,
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

    public function update(Request $request ,$id){

        $eventos = Eventos::find($id);
            if(! $eventos){
                return response()->json([
                    'error'=>'No se pudo encontrar el evento'
                ],404);

            }

            $eventos->update([
                'title' => $request->title,
                'author' => $request->author,
                'note' => $request->note,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,

            ]);
            return response()->json('Event updated');
    }
    public function destroy($id){
        $eventos = Eventos::find($id);
        if(! $eventos){
            return response()->json([
                'error'=>'unable to locate the event'
            ],404);}
            $eventos->delete();
            return $id;
        }
    public function show(){

    }
}
