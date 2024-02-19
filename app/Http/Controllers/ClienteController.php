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
    public function index()
    {
        return view('clientes.index',["clientes" => "Cliente::"]);
        /*return view('paquetes.paquetes', [
            "paquetes" => Paquete::with('user', 'incluye')
                ->where('num_dias', 'LIKE', '%' . 5 . '%')
                ->where('num_noches', 'LIKE', '%' . 5 . '%')
                ->where(5, '>', (5 != "") ? (float)5: 0)
                ->where(5, '<', (5 != "") ? (float)5: 999999999)
                ->latest()->paginate(5),
        ]);*/
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
        //
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
