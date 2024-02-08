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
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        return view('paquetes.paquetes', [
            "paquetes" => Paquete::with('user', 'incluye')
            ->where('num_dias', 'LIKE', '%' . $busqueda . '%')
            ->where('num_noches','LIKE', '%' . $busqueda . '%')->latest()->paginate(2), 
            "busqueda" => $busqueda
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
        file_put_contents("text3.txt", $listaJson);
        return view('paquetes.edit', ['paquete' => $paquete, 'listaJson' => $listaJson]);
    }

    public function update(Request $request)
    {
        $listaModificada = $request->get("lista_caracteristicas_mod");
        $stringVerificacion = "Descripción: " . $request->get("message") . "\n" .
            "Nombre del Paquete: " . $request->get("nombre_paquete") . "\n" .
            "Número de Días: " . $request->get("num_dias") . "\n" .
            "Número de Noches: " . $request->get("num_noches") . "\n" .
            "Precio Afiliado: " . $request->get("precio_afiliado") . "\n" .
            "Precio No Afiliado: " . $request->get("precio_no_afiliado") . "\n" .
            "Imagen del Paquete: " . $request->get("imagen_paquete");

        file_put_contents("archivoVerEditar.txt", $stringVerificacion);
        file_put_contents("archivoVerListaCaracteristicas.txt", $listaModificada);
        $validated = $request->validate([
            'message' => ['required', 'min:3', 'max:255'],
            'nombre_paquete' => ['required', 'min:5', 'max:255'],
            'num_dias' => ['required', 'integer', 'min:1'],
            'num_noches' => ['required', 'integer', 'min:1'],
            'precio_afiliado' => ['required', 'numeric', 'min:0.01', 'max:9999.99'],
            'precio_no_afiliado' => ['required', 'numeric', 'min:0.01', 'max:9999.99'],
        ]);

        if ($request->hasFile('imagen_paquete')) {
            file_put_contents("verTieneImagen.txt", "Esta entrando en el if que tiene imagen");
            $file = $request->file('imagen_paquete');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('uploads/paquetes/', $filename);
            $validated['imagen_paquete'] = $filename;
        } else {
            file_put_contents("verTieneImagen.txt", "No Esta entrando en el if que tiene imagen");
        }

        if ($listaModificada != "") {
            $listaCaracteristicas = json_decode($request->get('lista_caracteristicas_mod'));
            foreach ($listaCaracteristicas as $caracteristica) {
                $tempCar = CaracteristicaPaquete::find($caracteristica->id);
                $tempCar->descripcion = $caracteristica->descripcion;
                $tempCar->lugar = $caracteristica->lugar;
                $tempCar->save();
            }
            file_put_contents("verificacionLista.txt", "La lista no es vacia");
        } else {
            file_put_contents("errorLista.txt", "La lista es vacia");
        }

        $request->user()->paquetes()->update($validated);
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
