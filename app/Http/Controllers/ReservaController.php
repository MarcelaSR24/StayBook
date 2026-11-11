<?php

namespace App\Http\Controllers;

use App\Models\Alojamiento;
use App\Models\Reserva;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReservaController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('viewAny', Reserva::class);

        $user = $request->user();
        $query = Reserva::with(['alojamiento', 'usuario'])->latest();

        if ($user->isRole(User::ROLE_CLIENT)) {
            $query->where('user_id', $user->id);
        } elseif ($user->isRole(User::ROLE_OWNER)) {
            $query->whereHas('alojamiento', fn ($alojamientos) => $alojamientos->where('user_id', $user->id));
        }

        return view('reservas.index', ['reservas' => $query->paginate(20)]);
    }

    public function create(): View
    {
        $this->authorize('create', Reserva::class);
        $alojamientos = Alojamiento::disponibles()->orderBy('nombre')->get();

        return view('reservas.create', compact('alojamientos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Reserva::class);

        $datos = $request->validate([
            'alojamiento_id' => ['required', 'exists:alojamientos,id'],
            'fecha_entrada' => ['required', 'date', 'after_or_equal:today'],
            'fecha_salida' => ['required', 'date', 'after:fecha_entrada'],
            'cantidad_huespedes' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($datos, $request): void {
            $alojamiento = Alojamiento::query()->whereKey($datos['alojamiento_id'])->lockForUpdate()->firstOrFail();

            if ($alojamiento->estado !== 'disponible' || $alojamiento->user_id === null) {
                throw ValidationException::withMessages([
                    'alojamiento_id' => 'Este alojamiento no está disponible.',
                ]);
            }

            if ($datos['cantidad_huespedes'] > $alojamiento->capacidad) {
                throw ValidationException::withMessages([
                    'cantidad_huespedes' => 'La cantidad de huéspedes supera la capacidad del alojamiento.',
                ]);
            }

            $reservaExistente = Reserva::query()
                ->where('alojamiento_id', $alojamiento->id)
                ->whereIn('estado', ['pendiente', 'confirmada'])
                ->where('fecha_entrada', '<', $datos['fecha_salida'])
                ->where('fecha_salida', '>', $datos['fecha_entrada'])
                ->lockForUpdate()
                ->exists();

            if ($reservaExistente) {
                throw ValidationException::withMessages([
                    'fecha_entrada' => 'El alojamiento ya tiene una reserva para esas fechas.',
                ]);
            }

            $noches = Carbon::parse($datos['fecha_entrada'])->diffInDays(Carbon::parse($datos['fecha_salida']));
            $precioNoche = number_format((float) $alojamiento->precio_por_noche, 2, '.', '');
            [$unidades, $centavos] = array_pad(explode('.', $precioNoche, 2), 2, '00');
            $precioTotalCentavos = (((int) $unidades * 100) + (int) str_pad(substr($centavos, 0, 2), 2, '0')) * $noches;

            if ($precioTotalCentavos > 999999999999) {
                throw ValidationException::withMessages([
                    'fecha_salida' => 'El valor total supera el máximo permitido para una reserva.',
                ]);
            }

            $precioTotal = intdiv($precioTotalCentavos, 100).'.'.str_pad((string) ($precioTotalCentavos % 100), 2, '0', STR_PAD_LEFT);

            $request->user()->reservas()->create([
                'alojamiento_id' => $alojamiento->id,
                'fecha_entrada' => $datos['fecha_entrada'],
                'fecha_salida' => $datos['fecha_salida'],
                'cantidad_huespedes' => $datos['cantidad_huespedes'],
                'precio_total' => $precioTotal,
                'estado' => 'pendiente',
            ]);
        });

        return redirect()->route('reservas.index')->with('success', '¡Tu reserva se ha registrado correctamente!');
    }

    public function show(Reserva $reserva): View
    {
        $this->authorize('view', $reserva);
        $reserva->load(['alojamiento', 'usuario']);

        return view('reservas.show', compact('reserva'));
    }

    public function cancel(Request $request, Reserva $reserva): RedirectResponse
    {
        $this->authorize('update', $reserva);

        DB::transaction(function () use ($reserva): void {
            $lockedReserva = Reserva::query()->whereKey($reserva->id)->lockForUpdate()->firstOrFail();

            if ($lockedReserva->estado === 'cancelada') {
                throw ValidationException::withMessages(['reserva' => 'Esta reserva ya está cancelada.']);
            }

            $lockedReserva->update(['estado' => 'cancelada']);
        });

        return redirect()->route('reservas.index')->with('success', 'La reserva se ha cancelado correctamente.');
    }

    public function confirm(Reserva $reserva): RedirectResponse
    {
        $this->authorize('confirm', $reserva);

        DB::transaction(function () use ($reserva): void {
            $lockedReserva = Reserva::query()->whereKey($reserva->id)->lockForUpdate()->firstOrFail();
            $this->authorize('confirm', $lockedReserva);
            $lockedReserva->update(['estado' => 'confirmada']);
        });

        return redirect()->route('reservas.index')->with('success', 'La reserva se ha confirmado correctamente.');
    }
}
