
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StayBook | Alojamientos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand fw-bold" href="{{ route('alojamientos.index') }}">
                StayBook
            </a>

            @if (Auth::check())
                <div class="d-flex align-items-center gap-3">
                    <span class="text-white">
                        Bienvenido, {{ Auth::user()->name }}
                    </span>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            @else
                <div>
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                        Iniciar sesión
                    </a>

                    <a href="{{ route('register') }}" class="btn btn-light btn-sm">
                        Registrarse
                    </a>
                </div>
            @endif

        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3">Gestión de alojamientos</h1>
                <p class="text-muted mb-0">
                    Administra los hoteles, apartamentos, casas, cabañas y habitaciones.
                </p>
            </div>

            <a href="{{ route('alojamientos.create') }}" class="btn btn-primary">
                + Registrar alojamiento
            </a>
        </div>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Listado de alojamientos -->
        @if($alojamientos->isEmpty())

            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <h5>No hay alojamientos registrados</h5>

                    <p class="text-muted">
                        Comienza registrando el primer alojamiento en StayBook.
                    </p>

                    <a href="{{ route('alojamientos.create') }}" class="btn btn-primary">
                        Registrar primer alojamiento
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
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Ciudad</th>
                                    <th>Precio por noche</th>
                                    <th>Capacidad</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($alojamientos as $alojamiento)

                                    <tr>
                                        <td>{{ $alojamiento->nombre }}</td>

                                        <td>{{ ucfirst($alojamiento->tipo) }}</td>

                                        <td>{{ $alojamiento->ciudad }}</td>

                                        <td>
                                            ${{ number_format($alojamiento->precio_por_noche, 0, ',', '.') }}
                                        </td>

                                        <td>
                                            {{ $alojamiento->capacidad }} personas
                                        </td>

                                        <td>
                                            @if($alojamiento->estado === 'disponible')
                                                <span class="badge bg-success">
                                                    Disponible
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    No disponible
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('alojamientos.show', $alojamiento) }}"
                                               class="btn btn-sm btn-info text-white">
                                                Ver
                                            </a>

                                            <a href="{{ route('alojamientos.edit', $alojamiento) }}"
                                               class="btn btn-sm btn-warning">
                                                Editar
                                            </a>

                                            <form action="{{ route('alojamientos.destroy', $alojamiento) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('¿Estás segura de eliminar este alojamiento?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        @endif

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
