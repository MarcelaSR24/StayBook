
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de reserva | StayBook</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('alojamientos.index') }}">
                StayBook
            </a>

            <div class="d-flex align-items-center gap-3">
                <span class="text-white">
                    {{ Auth::user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container">

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">

                <div class="card shadow-sm">
                    <div class="card-body p-4">

                        <h1 class="h3 mb-4">Detalle de la reserva</h1>

                        <div class="mb-3">
                            <strong>Número de reserva:</strong>
                            #{{ $reserva->id }}
                        </div>

                        <div class="mb-3">
                            <strong>Alojamiento:</strong>
                            {{ $reserva->alojamiento->nombre }}
                        </div>

                        <div class="mb-3">
                            <strong>Ciudad:</strong>
                            {{ $reserva->alojamiento->ciudad }}
                        </div>

                        <div class="mb-3">
                            <strong>Dirección:</strong>
                            {{ $reserva->alojamiento->direccion }}
                        </div>

                        <div class="mb-3">
                            <strong>Tipo de alojamiento:</strong>
                            {{ ucfirst($reserva->alojamiento->tipo) }}
                        </div>

                        <hr>

                        <div class="mb-3">
                            <strong>Fecha de entrada:</strong>
                            {{ $reserva->fecha_entrada->format('d/m/Y') }}
                        </div>

                        <div class="mb-3">
                            <strong>Fecha de salida:</strong>
                            {{ $reserva->fecha_salida->format('d/m/Y') }}
                        </div>

                        <div class="mb-3">
                            <strong>Cantidad de huéspedes:</strong>
                            {{ $reserva->cantidad_huespedes }}
                        </div>

                        <div class="mb-3">
                            <strong>Precio por noche:</strong>
                            ${{ number_format($reserva->alojamiento->precio_por_noche, 0, ',', '.') }}
                        </div>

                        <div class="mb-3">
                            <strong>Precio total:</strong>
                            <span class="text-primary fw-bold">
                                ${{ number_format($reserva->precio_total, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="mb-4">
                            <strong>Estado:</strong>

                            @if($reserva->estado === 'pendiente')
                                <span class="badge bg-warning text-dark">
                                    Pendiente
                                </span>
                            @elseif($reserva->estado === 'confirmada')
                                <span class="badge bg-success">
                                    Confirmada
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    Cancelada
                                </span>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('reservas.index') }}"
                               class="btn btn-outline-secondary">
                                Volver a mis reservas
                            </a>

                            @if($reserva->estado !== 'cancelada')
                                <form action="{{ route('reservas.cancel', $reserva) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Deseas cancelar esta reserva?')">

                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="btn btn-danger">
                                        Cancelar reserva
                                    </button>
                                </form>
                            @endif

                        </div>

                    </div>
                </div>

            </div>
        </div>

    </main>

</body>
</html>
