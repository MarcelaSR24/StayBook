<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva #{{ $reserva->id }} | StayBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary mb-4"><div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('alojamientos.index') }}">StayBook</a>
    <div class="d-flex gap-2"><a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm">Panel</a>
        <form action="{{ route('logout') }}" method="POST">@csrf<button class="btn btn-outline-light btn-sm">Cerrar sesión</button></form></div>
</div></nav>
<main class="container"><div class="row justify-content-center"><div class="col-lg-8"><div class="card shadow-sm"><div class="card-body p-4">
    <h1 class="h3 mb-4">Detalle de la reserva #{{ $reserva->id }}</h1>
    <dl class="row">
        <dt class="col-sm-5">Alojamiento</dt><dd class="col-sm-7">{{ $reserva->alojamiento?->nombre ?? 'Alojamiento archivado' }}</dd>
        @if($reserva->alojamiento)<dt class="col-sm-5">Ciudad y dirección</dt><dd class="col-sm-7">{{ $reserva->alojamiento->ciudad }} · {{ $reserva->alojamiento->direccion }}</dd>
            <dt class="col-sm-5">Tipo</dt><dd class="col-sm-7">{{ ucfirst($reserva->alojamiento->tipo) }}</dd>
            <dt class="col-sm-5">Precio por noche</dt><dd class="col-sm-7">${{ number_format($reserva->alojamiento->precio_por_noche, 0, ',', '.') }}</dd>@endif
        @if(!Auth::user()->isRole('client'))<dt class="col-sm-5">Cliente</dt><dd class="col-sm-7">{{ $reserva->usuario?->name ?? 'Cuenta archivada' }} · {{ $reserva->usuario?->email }}</dd>@endif
        <dt class="col-sm-5">Entrada</dt><dd class="col-sm-7">{{ $reserva->fecha_entrada->format('d/m/Y') }}</dd>
        <dt class="col-sm-5">Salida</dt><dd class="col-sm-7">{{ $reserva->fecha_salida->format('d/m/Y') }}</dd>
        <dt class="col-sm-5">Noches</dt><dd class="col-sm-7">{{ $reserva->fecha_entrada->diffInDays($reserva->fecha_salida) }}</dd>
        <dt class="col-sm-5">Huéspedes</dt><dd class="col-sm-7">{{ $reserva->cantidad_huespedes }}</dd>
        <dt class="col-sm-5">Precio total</dt><dd class="col-sm-7 fw-bold text-primary">${{ number_format($reserva->precio_total, 0, ',', '.') }}</dd>
        <dt class="col-sm-5">Estado</dt><dd class="col-sm-7"><span class="badge {{ $reserva->estado === 'confirmada' ? 'bg-success' : ($reserva->estado === 'pendiente' ? 'bg-warning text-dark' : 'bg-secondary') }}">{{ ucfirst($reserva->estado) }}</span></dd>
    </dl>
    <div class="d-flex justify-content-between mt-4"><a href="{{ route('reservas.index') }}" class="btn btn-outline-secondary">Volver a reservas</a><div class="d-flex gap-2">
        @if($reserva->estado === 'pendiente' && (Auth::user()->isRole('admin') || (Auth::user()->isRole('owner') && $reserva->alojamiento?->user_id === Auth::id())))
            <form action="{{ route('reservas.confirm', $reserva) }}" method="POST">@csrf @method('PATCH')<button class="btn btn-success">Confirmar reserva</button></form>
        @endif
        @can('update', $reserva) @if($reserva->estado !== 'cancelada')<form action="{{ route('reservas.cancel', $reserva) }}" method="POST" onsubmit="return confirm('¿Deseas cancelar esta reserva?')">@csrf @method('PATCH')<button class="btn btn-danger">Cancelar reserva</button></form>@endif @endcan
    </div></div>
</div></div></div></div></main>
</body>
</html>
