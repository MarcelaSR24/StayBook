
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StayBook | Detalles del alojamiento</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('alojamientos.index') }}">
                StayBook
            </a>
        </div>
    </nav>

    <main class="container">
        <div class="card shadow-sm mx-auto" style="max-width: 800px;">

            <div class="card-header bg-white py-3">
                <h1 class="h4 mb-0">Detalles del alojamiento</h1>
            </div>

            <div class="card-body p-4">

                <h2 class="h3 mb-3">{{ $alojamiento->nombre }}</h2>

                <p class="text-muted">
                    {{ $alojamiento->descripcion ?? 'Sin descripción registrada.' }}
                </p>

                <hr>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Tipo de alojamiento:</strong>
                        <p>{{ ucfirst($alojamiento->tipo) }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Ciudad:</strong>
                        <p>{{ $alojamiento->ciudad }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Dirección:</strong>
                        <p>{{ $alojamiento->direccion }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Precio por noche:</strong>
                        <p>${{ number_format($alojamiento->precio_por_noche, 0, ',', '.') }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Capacidad:</strong>
                        <p>{{ $alojamiento->capacidad }} personas</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Estado:</strong>
                        <p>
                            @if($alojamiento->estado === 'disponible')
                                <span class="badge bg-success">Disponible</span>
                            @else
                                <span class="badge bg-secondary">No disponible</span>
                            @endif
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Fecha de registro:</strong>
                        <p>{{ $alojamiento->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <hr>

                <div class="d-flex gap-2">
                    <a href="{{ route('alojamientos.edit', $alojamiento) }}"
                       class="btn btn-warning">
                        Editar alojamiento
                    </a>

                    <a href="{{ route('alojamientos.index') }}"
                       class="btn btn-secondary">
                        Volver al listado
                    </a>
                </div>

            </div>
        </div>
    </main>

</body>
</html>
