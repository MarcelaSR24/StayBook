
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis reservas | StayBook</title>

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
                    <button class="btn btn-outline-light btn-sm" type="submit">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3">Mis reservas</h1>
                <p class="text-muted mb-0">
                    Consulta y administra tus reservas en StayBook.
                </p>
            </div>

            <a href="{{ route('reservas.create') }}" class="btn btn-primary">
                + Nueva reserva
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($reservas->isEmpty())

            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <h5>Aún no tienes reservas</h5>

                    <p class="text-muted">
                        Cuando registres una reserva, aparecerá aquí.
                    </p>

                    <a href="{{ route('reservas.create') }}" class="btn btn-primary">
                        Registrar mi primera reserva
                    </a>
                </div>
            </div>

        @else

            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">

                            <thead class="table-light">
                                <tr>
                                    <th>Alojamiento</th>
                                    <th>Entrada</th>
                                    <th>Salida</th>
                                    <th>Huéspedes</th>
                                    <th>Precio total</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($reservas as $reserva)
                                    <tr>
                                        <td>{{ $reserva->alojamiento->nombre }}</td>

                                        <td>{{ $reserva->fecha_entrada->format('d/m/Y') }}</td>

                                        <td>{{ $reserva->fecha_salida->format('d/m/Y') }}</td>

                                        <td>{{ $reserva->cantidad_huespedes }}</td>

                                        <td>
                                            ${{ number_format($reserva->precio_total, 0, ',', '.') }}
                                        </td>

                                        <td>
                                            @if($reserva->estado === 'pendiente')
                                                <span class="badge bg-warning text-dark">Pendiente</span>
                                            @elseif($reserva->estado === 'confirmada')
                                                <span class="badge bg-success">Confirmada</span>
                                            @else
                                                <span class="badge bg-secondary">Cancelada</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('reservas.show', $reserva) }}"
                                               class="btn btn-sm btn-info text-white">
                                                Ver
                                            </a>

                                            @if($reserva->estado !== 'cancelada')
                                                <form action="{{ route('reservas.cancel', $reserva) }}"
                                                      method="POST"
                                                      class="d-inline"
                                                      onsubmit="return confirm('¿Deseas cancelar esta reserva?')">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        Cancelar
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        @endif

        <div class="mt-4">
            <a href="{{ route('alojamientos.index') }}" class="btn btn-outline-secondary">
                Volver a alojamientos
            </a>
        </div>

    </main>

</body>
</html>
