<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Paquete;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('clientes.index',["clientes" => Cliente::with('user')->get()]);
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
        
        $validated = $request->validate([
            'cedula' => ['required', 'min:10', 'max:10'],
            'nombres' => ['required', 'min:5', 'max:255'],
            'apellidos' => ['required', 'integer', 'min:1'],
            'numTelefonico' => ['required', 'integer', 'min:1'],
            'email' => ['required', 'numeric', 'min:0.01', 'max:9999.99'],
            'ciudad' => ['required', 'numeric', 'min:0.01', 'max:9999.99'],
            'provincia' => ['required', 'numeric', 'min:0.01', 'max:9999.99'],
            
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
