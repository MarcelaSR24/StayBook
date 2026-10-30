<?php

namespace App\Http\Controllers;

use App\Models\Alojamiento;
use Illuminate\Http\Request;

class AlojamientoController extends Controller
{
    public function index()
    {
        $alojamientos = Alojamiento::latest()->get();

        return view('alojamientos.index', compact('alojamientos'));
    }

    public function create()
    {
        return view('alojamientos.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'tipo' => 'required|in:hotel,apartamento,casa,cabana,habitacion',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'precio_por_noche' => 'required|numeric|min:0',
            'capacidad' => 'required|integer|min:1|max:65535',
            'estado' => 'required|in:disponible,no disponible',
        ]);

        Alojamiento::create($datos);

        return redirect()
            ->route('alojamientos.index')
            ->with('success', 'Alojamiento registrado correctamente.');
    }

    public function show(Alojamiento $alojamiento)
    {
        return view('alojamientos.show', compact('alojamiento'));
    }

    public function edit(Alojamiento $alojamiento)
    {
        return view('alojamientos.edit', compact('alojamiento'));
    }

    public function update(Request $request, Alojamiento $alojamiento)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'tipo' => 'required|in:hotel,apartamento,casa,cabana,habitacion',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'precio_por_noche' => 'required|numeric|min:0',
            'capacidad' => 'required|integer|min:1|max:65535',
            'estado' => 'required|in:disponible,no disponible',
        ]);

        $alojamiento->update($datos);

        return redirect()
            ->route('alojamientos.index')
            ->with('success', 'Alojamiento actualizado correctamente.');
    }

    public function destroy(Alojamiento $alojamiento)
    {
        $alojamiento->delete();

        return redirect()
            ->route('alojamientos.index')
            ->with('success', 'Alojamiento eliminado correctamente.');
    }
}