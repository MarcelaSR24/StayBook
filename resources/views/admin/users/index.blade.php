<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios | StayBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary mb-4"><div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">StayBook · Administración</a>
    <div class="d-flex gap-2"><a href="{{ route('reservas.index') }}" class="btn btn-outline-light btn-sm">Reservas</a>
        <form action="{{ route('logout') }}" method="POST">@csrf<button class="btn btn-outline-light btn-sm">Cerrar sesión</button></form></div>
</div></nav>
<main class="container">
    <h1 class="h3 mb-3">Usuarios</h1>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    <div class="card"><div class="table-responsive"><table class="table table-striped align-middle mb-0">
        <thead><tr><th>Nombre</th><th>Correo</th><th>Rol</th><th>Estado</th><th>Actualizar rol</th></tr></thead>
        <tbody>@foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td><td>{{ $user->email }}</td>
                <td>{{ $user->role ?? 'Sin asignar' }}</td><td>{{ $user->trashed() ? 'Archivada' : 'Activa' }}</td>
                <td>
                    @if(!$user->trashed())
                        <form action="{{ route('admin.users.role', $user) }}" method="POST" class="d-flex gap-2">
                            @csrf @method('PATCH')
                            <select name="role" class="form-select form-select-sm" aria-label="Rol de {{ $user->name }}">
                                @foreach(['client' => 'Cliente', 'owner' => 'Propietario', 'admin' => 'Administrador'] as $value => $label)
                                    <option value="{{ $value }}" @selected($user->role === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-sm btn-primary">Guardar</button>
                        </form>
                    @else
                        <span class="text-muted">Cuenta archivada</span>
                    @endif
                </td>
            </tr>
        @endforeach</tbody>
    </table></div></div>
    <div class="mt-3">{{ $users->links() }}</div>
</main>
</body>
</html>
