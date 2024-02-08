<?php

namespace App\Http\Controllers;

use App\Models\Paquete;
use App\Models\CaracteristicaPaquete;
use Illuminate\Http\Request;

class PaqueteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('paquetes.paquetes', [
            "paquetes" => Paquete::with('user', 'incluye')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        file_put_contents("text1.txt", "Esta entrando en el metodo store ");
        $validated = $request->validate([
            'message' => ['required', 'min:3', 'max:255'],
            'nombre_paquete' => ['required', 'min:5', 'max:255'],
            'num_dias' => ['required', 'integer', 'min:1'],
            'num_noches' => ['required', 'integer', 'min:1'],
            'precio_afiliado' => ['required', 'numeric', 'min:0.01', 'max:9999.99'],
            'precio_no_afiliado' => ['required', 'numeric', 'min:0.01', 'max:9999.99'],
            'imagen_paquete' => ['required', 'min:3', 'max:255'],
        ]);
        
        if ($request->hasFile('imagen_paquete')) {
            $file = $request->file('imagen_paquete');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('uploads/paquetes/', $filename);
            $validated['imagen_paquete'] = $filename;
        }

        $paquete = $request->user()->paquetes()->create($validated);
        $listaCaracteristicas = json_decode($request->get('lista_caracteristicas'));
        foreach ($listaCaracteristicas as $caracteristica) {
            CaracteristicaPaquete::create([
                'paquete_id' => $paquete->id,
                'descripcion' => $caracteristica[0],
                'lugar' => $caracteristica[1], 
            ]);
        }
        return to_route('paquetes.paquetes')
            ->with('status',  __('Insertion done successfully'));
    }

    public function show(Paquete $paquete)
    {
        //
    }

    public function edit(Paquete $paquete)
    {
        // Convertir la propiedad lista_caracteristicas a una cadena JSON
        $listaJson = json_encode($paquete->incluye);
        file_put_contents("text3.txt", $listaJson) ;
        return view('paquetes.edit', ['paquete' => $paquete, 'listaJson' => $listaJson]);
    }

    public function update(Request $request, Paquete $paquete)
    {
        $nombrePaquete = $request->get("lista_caracteristicas_mod"); 
        file_put_contents("nombrePaqueteActualizar.txt", $nombrePaquete) ;
        $validated = $request->validate([
            'message' => ['required', 'min:3', 'max:255'],
            'nombre_paquete' => ['required', 'min:5', 'max:255'],
            'num_dias' => ['required', 'integer', 'min:1'],
            'num_noches' => ['required', 'integer', 'min:1'],
            'precio_afiliado' => ['required', 'numeric', 'min:0.01', 'max:9999.99'],
            'precio_no_afiliado' => ['required', 'numeric', 'min:0.01', 'max:9999.99'],
            'imagen_paquete' => ['required', 'min:3', 'max:255'],
        ]);
        
        if ($request->hasFile('imagen_paquete')) {
            $file = $request->file('imagen_paquete');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('uploads/paquetes/', $filename);
            $validated['imagen_paquete'] = $filename;
        }

        $paquete = $request->user()->paquetes()->create($validated);
        $listaCaracteristicas = json_decode($request->get('lista_caracteristicas'));
        $paquete->update($validated);
        return to_route('paquetes.paquetes')
            ->with('status', __('Package updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paquete $paquete)
    {
        $paquete->delete();
        return to_route('paquetes.paquetes')
            ->with('status', __('Package deleted successfully'));
    }
}
