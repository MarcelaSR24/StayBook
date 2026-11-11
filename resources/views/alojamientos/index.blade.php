<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alojamientos | StayBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary mb-4">
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand fw-bold" href="{{ route('alojamientos.index') }}">StayBook</a>
        <div class="d-flex align-items-center gap-2">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm">Panel</a>
                @if(Auth::user()->isRole('owner'))
                    <a href="{{ route('alojamientos.manage') }}" class="btn btn-outline-light btn-sm">Mis alojamientos</a>
                @elseif(Auth::user()->isRole('admin'))
                    <a href="{{ route('admin.alojamientos.index') }}" class="btn btn-outline-light btn-sm">Administrar</a>
                @endif
                <span class="text-white">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">@csrf<button class="btn btn-outline-light btn-sm">Cerrar sesión</button></form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="btn btn-light btn-sm">Registrarse</a>
            @endauth
        </div>
    </div>
</nav>
<main class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3">{{ request()->routeIs('alojamientos.manage') ? 'Mis alojamientos' : (request()->routeIs('admin.alojamientos.index') ? 'Todos los alojamientos' : 'Alojamientos disponibles') }}</h1>
            <p class="text-muted mb-0">Explora hoteles, apartamentos, casas, cabañas y habitaciones.</p>
        </div>
        @if(Auth::check() && Auth::user()->isRole('owner') && request()->routeIs('alojamientos.manage'))
            <a href="{{ route('alojamientos.create') }}" class="btn btn-primary">+ Registrar alojamiento</a>
        @endif
    </div>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if($alojamientos->isEmpty())
        <div class="card shadow-sm"><div class="card-body text-center py-5">
            <h2 class="h5">No hay alojamientos para mostrar</h2>
            <p class="text-muted">Los alojamientos disponibles aparecerán aquí.</p>
            @if(Auth::check() && Auth::user()->isRole('owner') && request()->routeIs('alojamientos.manage'))
                <a href="{{ route('alojamientos.create') }}" class="btn btn-primary">Registrar primer alojamiento</a>
            @endif
        </div></div>
    @else
        <div class="card shadow-sm"><div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>Nombre</th><th>Tipo</th><th>Ciudad</th><th>Precio por noche</th><th>Capacidad</th><th>Estado</th>
                    @if(request()->routeIs('alojamientos.manage', 'admin.alojamientos.index'))<th>Propietario</th>@endif
                    <th>Acciones</th></tr></thead>
                <tbody>
                @foreach($alojamientos as $alojamiento)
                    <tr>
                        <td>{{ $alojamiento->nombre }}</td><td>{{ ucfirst($alojamiento->tipo) }}</td><td>{{ $alojamiento->ciudad }}</td>
                        <td>${{ number_format($alojamiento->precio_por_noche, 0, ',', '.') }}</td><td>{{ $alojamiento->capacidad }} personas</td>
                        <td><span class="badge {{ $alojamiento->estado === 'disponible' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($alojamiento->estado) }}</span></td>
                        @if(request()->routeIs('alojamientos.manage', 'admin.alojamientos.index'))<td>{{ $alojamiento->propietario?->name ?? 'Sin asignar' }}</td>@endif
                        <td class="text-nowrap">
                            <a href="{{ route('alojamientos.show', $alojamiento) }}" class="btn btn-sm btn-info text-white">Ver</a>
                            @can('update', $alojamiento)
                                @php($editRoute = Auth::user()->isRole('admin') ? 'admin.alojamientos.edit' : 'alojamientos.edit')
                                @php($deleteRoute = Auth::user()->isRole('admin') ? 'admin.alojamientos.destroy' : 'alojamientos.destroy')
                                <a href="{{ route($editRoute, $alojamiento) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route($deleteRoute, $alojamiento) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Deseas archivar este alojamiento? Su historial de reservas se conservará.')">
                                    @csrf @method('DELETE')<button class="btn btn-sm btn-danger">Archivar</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div></div>
        <div class="mt-3">{{ $alojamientos->links() }}</div>
    @endif
</main>
</body>
</html>
