<?php

namespace App\Http\Controllers;

use App\Models\Paquete;
use Illuminate\Http\Request;

class PaqueteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('paquetes.paquetes', ["paquetes" => Paquete::with('user')->latest()->get()]);
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
            'message' =>['required', 'min:3', 'max:255'], 
        ]); 

        $request->user()->paquetes()->create($validated); 
        
        return to_route('paquetes.paquetes')
            ->with('status',  __('Insertion done successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Paquete $paquete)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paquete $paquete)
    {
        return view('paquetes.edit', ['paquete' => $paquete]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paquete $paquete)
    {
        $validated = $request->validate([
            'message' =>['required', 'min:3', 'max:255'], 
        ]);
        $paquete ->update($validated); 
        return to_route('paquetes.paquetes')
        ->with('status', __('Package updated successfully')); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paquete $paquete)
    {
        $paquete ->delete(); 
        return to_route('paquetes.paquetes')
        ->with('status', __('Package deleted successfully')); 
    }
}
