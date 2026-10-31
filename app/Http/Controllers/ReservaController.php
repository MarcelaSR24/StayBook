<?php
namespace App\Http\Controllers;

use App\Models\Alojamiento;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ReservaController extends Controller
{
    // Mostrar las reservas del usuario autenticado
    public function index()
    {
        $reservas = Reserva::with('alojamiento')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('reservas.index', compact('reservas'));
    }

    // Mostrar formulario para crear una reserva
    public function create()
    {
        $alojamientos = Alojamiento::where('estado', 'disponible')
            ->orderBy('nombre')
            ->get();

        return view('reservas.create', compact('alojamientos'));
    }

    // Guardar una nueva reserva
    public function store(Request $request)
    {
        $datos = $request->validate([
            'alojamiento_id' => 'required|exists:alojamientos,id',
            'fecha_entrada' => 'required|date|after_or_equal:today',
            'fecha_salida' => 'required|date|after:fecha_entrada',
            'cantidad_huespedes' => 'required|integer|min:1',
        ]);

        $alojamiento = Alojamiento::findOrFail($datos['alojamiento_id']);

        if ($alojamiento->estado !== 'disponible') {
            throw ValidationException::withMessages([
                'alojamiento_id' => 'Este alojamiento no está disponible.',
            ]);
        }

        if ($datos['cantidad_huespedes'] > $alojamiento->capacidad) {
            throw ValidationException::withMessages([
                'cantidad_huespedes' => 'La cantidad de huéspedes supera la capacidad del alojamiento.',
            ]);
        }

        // Comprobar que no existan reservas que se crucen con las fechas solicitadas
        $reservaExistente = Reserva::where('alojamiento_id', $alojamiento->id)
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->where('fecha_entrada', '<', $datos['fecha_salida'])
            ->where('fecha_salida', '>', $datos['fecha_entrada'])
            ->exists();

        if ($reservaExistente) {
            throw ValidationException::withMessages([
                'fecha_entrada' => 'El alojamiento ya tiene una reserva para esas fechas.',
            ]);
        }

        // Calcular el precio total en el servidor
        $fechaEntrada = new \DateTime($datos['fecha_entrada']);
        $fechaSalida = new \DateTime($datos['fecha_salida']);
        $noches = $fechaEntrada->diff($fechaSalida)->days;

        $precioTotal = $noches * $alojamiento->precio_por_noche;

        Reserva::create([
            'user_id' => Auth::id(),
            'alojamiento_id' => $alojamiento->id,
            'fecha_entrada' => $datos['fecha_entrada'],
            'fecha_salida' => $datos['fecha_salida'],
            'cantidad_huespedes' => $datos['cantidad_huespedes'],
            'precio_total' => $precioTotal,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('reservas.index')
            ->with('success', '¡Tu reserva se ha registrado correctamente!');
    }

    // Mostrar los detalles de una reserva
    public function show(Reserva $reserva)
    {
        $this->autorizarReserva($reserva);

        $reserva->load('alojamiento');

        return view('reservas.show', compact('reserva'));
    }

    // Cancelar una reserva
    public function cancel(Reserva $reserva)
    {
        $this->autorizarReserva($reserva);

        if ($reserva->estado === 'cancelada') {
            return back()->with('error', 'Esta reserva ya está cancelada.');
        }

        $reserva->update([
            'estado' => 'cancelada',
        ]);

        return redirect()->route('reservas.index')
            ->with('success', 'La reserva se ha cancelado correctamente.');
    }

    // Verificar que la reserva pertenezca al usuario autenticado
    private function autorizarReserva(Reserva $reserva): void
    {
        abort_unless($reserva->user_id === Auth::id(), 403);
    }
}
