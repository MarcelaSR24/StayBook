<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel | StayBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary mb-4"><div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('alojamientos.index') }}">StayBook</a>
    <div class="d-flex align-items-center gap-2"><span class="text-white">{{ $user->name }}</span>
        <form action="{{ route('logout') }}" method="POST">@csrf<button class="btn btn-outline-light btn-sm">Cerrar sesión</button></form>
    </div>
</div></nav>
<main class="container">
    <h1 class="h3">Panel {{ match($user->role) { 'client' => 'del cliente', 'owner' => 'del propietario', 'admin' => 'de administración', default => 'de la cuenta' } }}</h1>
    <p class="text-muted">Bienvenido, {{ $user->name }} · {{ $user->email }}</p>
    @if($user->role === null)
        <div class="alert alert-warning">Esta cuenta todavía no tiene un rol asignado. Solicita al administrador que habilite tu perfil.</div>
    @else
        <div class="row g-3 mt-2">
            @if($user->isRole('client'))
                <div class="col-md-4"><a class="card card-body h-100 text-decoration-none" href="{{ route('alojamientos.index') }}"><strong>Buscar alojamientos</strong><span class="text-muted">Consulta las opciones disponibles.</span></a></div>
                <div class="col-md-4"><a class="card card-body h-100 text-decoration-none" href="{{ route('reservas.index') }}"><strong>Mis reservas</strong><span class="text-muted">Consulta o cancela tus reservas.</span></a></div>
                <div class="col-md-4"><a class="card card-body h-100 text-decoration-none" href="{{ route('reservas.create') }}"><strong>Nueva reserva</strong><span class="text-muted">Elige fechas y huéspedes.</span></a></div>
            @elseif($user->isRole('owner'))
                <div class="col-md-4"><a class="card card-body h-100 text-decoration-none" href="{{ route('alojamientos.manage') }}"><strong>Mis alojamientos</strong><span class="text-muted">Administra publicaciones y disponibilidad.</span></a></div>
                <div class="col-md-4"><a class="card card-body h-100 text-decoration-none" href="{{ route('alojamientos.create') }}"><strong>Registrar alojamiento</strong><span class="text-muted">Publica una nueva opción.</span></a></div>
                <div class="col-md-4"><a class="card card-body h-100 text-decoration-none" href="{{ route('reservas.index') }}"><strong>Reservas recibidas</strong><span class="text-muted">Consulta y confirma las solicitudes.</span></a></div>
            @elseif($user->isRole('admin'))
                @foreach(['usuarios' => route('admin.users.index'), 'alojamientos' => route('admin.alojamientos.index'), 'reservas' => route('reservas.index')] as $label => $url)
                    <div class="col-md-4"><a class="card card-body h-100 text-decoration-none" href="{{ $url }}"><strong>{{ ucfirst($label) }}</strong><span class="text-muted">{{ $stats[$label] }} en la plataforma</span></a></div>
                @endforeach
            @endif
        </div>
    @endif
</main>
</body>
</html>
