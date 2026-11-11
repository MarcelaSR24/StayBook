<?php

namespace App\Http\Controllers;

use App\Models\Alojamiento;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AlojamientoController extends Controller
{
    public function index(): View
    {
        $alojamientos = Alojamiento::disponibles()->with('propietario')->latest()->paginate(12);

        return view('alojamientos.index', compact('alojamientos'));
    }

    public function manage(Request $request): View
    {
        $query = Alojamiento::with('propietario')->latest();

        if (! $request->user()->isRole(User::ROLE_ADMIN)) {
            $query->whereBelongsTo($request->user(), 'propietario');
        }

        return view('alojamientos.index', ['alojamientos' => $query->paginate(20)]);
    }

    public function adminIndex(): View
    {
        return view('alojamientos.index', ['alojamientos' => Alojamiento::with('propietario')->latest()->paginate(20)]);
    }

    public function create(): View
    {
        $this->authorize('create', Alojamiento::class);

        return view('alojamientos.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Alojamiento::class);

        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'descripcion' => ['nullable', 'string'],
            'tipo' => ['required', 'in:hotel,apartamento,casa,cabana,habitacion'],
            'direccion' => ['required', 'string', 'max:255'],
            'ciudad' => ['required', 'string', 'max:100'],
            'precio_por_noche' => ['required', 'numeric', 'min:0'],
            'capacidad' => ['required', 'integer', 'min:1', 'max:65535'],
            'estado' => ['required', 'in:disponible,no disponible'],
        ]);

        $request->user()->alojamientos()->create($datos);

        return redirect()->route('alojamientos.manage')->with('success', 'Alojamiento registrado correctamente.');
    }

    public function show(Alojamiento $alojamiento): View
    {
        if ($alojamiento->estado !== 'disponible' || $alojamiento->user_id === null) {
            $this->authorize('view', $alojamiento);
        }

        return view('alojamientos.show', compact('alojamiento'));
    }

    public function edit(Alojamiento $alojamiento): View
    {
        $this->authorize('update', $alojamiento);
        $propietarios = auth()->user()->isRole(User::ROLE_ADMIN)
            ? User::where('role', User::ROLE_OWNER)->orderBy('name')->get()
            : collect();

        return view('alojamientos.edit', compact('alojamiento', 'propietarios'));
    }

    public function update(Request $request, Alojamiento $alojamiento): RedirectResponse
    {
        $this->authorize('update', $alojamiento);

        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'descripcion' => ['nullable', 'string'],
            'tipo' => ['required', 'in:hotel,apartamento,casa,cabana,habitacion'],
            'direccion' => ['required', 'string', 'max:255'],
            'ciudad' => ['required', 'string', 'max:100'],
            'precio_por_noche' => ['required', 'numeric', 'min:0'],
            'capacidad' => ['required', 'integer', 'min:1', 'max:65535'],
            'estado' => ['required', 'in:disponible,no disponible'],
        ]);

        if ($request->user()->isRole(User::ROLE_ADMIN)) {
            $asignacion = $request->validate([
                'propietario_id' => ['nullable', 'integer', 'exists:users,id'],
            ]);
            $propietarioId = $asignacion['propietario_id'] ?? null;

            if ($propietarioId !== null && ! User::whereKey($propietarioId)->where('role', User::ROLE_OWNER)->exists()) {
                return back()->withErrors(['propietario_id' => 'Selecciona una cuenta con rol de propietario.'])->withInput();
            }

            $datos['user_id'] = $propietarioId;
        }

        $alojamiento->forceFill($datos)->save();

        $route = $request->user()->isRole(User::ROLE_ADMIN) ? 'admin.alojamientos.index' : 'alojamientos.manage';

        return redirect()->route($route)->with('success', 'Alojamiento actualizado correctamente.');
    }

    public function destroy(Request $request, Alojamiento $alojamiento): RedirectResponse
    {
        $this->authorize('delete', $alojamiento);
        $alojamiento->delete();

        $route = $request->user()->isRole(User::ROLE_ADMIN) ? 'admin.alojamientos.index' : 'alojamientos.manage';

        return redirect()->route($route)->with('success', 'Alojamiento archivado. Su historial de reservas se conserva.');
    }
}
