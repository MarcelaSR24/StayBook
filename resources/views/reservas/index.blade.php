<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas | StayBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary mb-4"><div class="container d-flex justify-content-between">
    <a class="navbar-brand fw-bold" href="{{ route('alojamientos.index') }}">StayBook</a>
    <div class="d-flex gap-2"><a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm">Panel</a>
        <form action="{{ route('logout') }}" method="POST">@csrf<button class="btn btn-outline-light btn-sm">Cerrar sesión</button></form></div>
</div></nav>
<main class="container">
    @php($esCliente = Auth::user()->isRole('client'))
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div><h1 class="h3">{{ $esCliente ? 'Mis reservas' : (Auth::user()->isRole('owner') ? 'Reservas recibidas' : 'Todas las reservas') }}</h1>
            <p class="text-muted mb-0">{{ $esCliente ? 'Consulta tus solicitudes y fechas.' : 'Consulta y administra las solicitudes de StayBook.' }}</p></div>
        @if($esCliente)<a href="{{ route('reservas.create') }}" class="btn btn-primary">+ Nueva reserva</a>@endif
    </div>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    @if($reservas->isEmpty())
        <div class="card"><div class="card-body text-center py-5"><h2 class="h5">No hay reservas para mostrar</h2>
            @if($esCliente)<p class="text-muted">Cuando reserves un alojamiento, aparecerá aquí.</p><a href="{{ route('alojamientos.index') }}" class="btn btn-primary">Buscar alojamientos</a>@endif
        </div></div>
    @else
        <div class="card shadow-sm"><div class="table-responsive"><table class="table table-hover align-middle mb-0">
            <thead class="table-light"><tr><th>Alojamiento</th>@if(!$esCliente)<th>Cliente</th>@endif<th>Entrada</th><th>Salida</th><th>Huéspedes</th><th>Total</th><th>Estado</th><th>Acciones</th></tr></thead>
            <tbody>@foreach($reservas as $reserva)
                <tr>
                    <td>{{ $reserva->alojamiento?->nombre ?? 'Alojamiento archivado' }}</td>
                    @if(!$esCliente)<td>{{ $reserva->usuario?->name ?? 'Cuenta archivada' }}<br><small class="text-muted">{{ $reserva->usuario?->email }}</small></td>@endif
                    <td>{{ $reserva->fecha_entrada->format('d/m/Y') }}</td><td>{{ $reserva->fecha_salida->format('d/m/Y') }}</td>
                    <td>{{ $reserva->cantidad_huespedes }}</td><td>${{ number_format($reserva->precio_total, 0, ',', '.') }}</td>
                    <td><span class="badge {{ $reserva->estado === 'confirmada' ? 'bg-success' : ($reserva->estado === 'pendiente' ? 'bg-warning text-dark' : 'bg-secondary') }}">{{ ucfirst($reserva->estado) }}</span></td>
                    <td class="text-nowrap"><a href="{{ route('reservas.show', $reserva) }}" class="btn btn-sm btn-info text-white">Ver</a>
                        @if($reserva->estado === 'pendiente' && (Auth::user()->isRole('admin') || Auth::user()->isRole('owner')))
                            <form action="{{ route('reservas.confirm', $reserva) }}" method="POST" class="d-inline">@csrf @method('PATCH')<button class="btn btn-sm btn-success">Confirmar</button></form>
                        @endif
                        @can('update', $reserva)
                            @if($reserva->estado !== 'cancelada')<form action="{{ route('reservas.cancel', $reserva) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Deseas cancelar esta reserva?')">@csrf @method('PATCH')<button class="btn btn-sm btn-danger">Cancelar</button></form>@endif
                        @endcan
                    </td>
                </tr>
            @endforeach</tbody>
        </table></div></div>
        <div class="mt-3">{{ $reservas->links() }}</div>
    @endif
</main>
</body>
</html>
