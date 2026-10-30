
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StayBook | Registrar alojamiento</title>

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
        <div class="card shadow-sm mx-auto" style="max-width: 850px;">
            <div class="card-header bg-white py-3">
                <h1 class="h4 mb-0">Registrar nuevo alojamiento</h1>
            </div>

            <div class="card-body p-4">

                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Por favor, corrige los siguientes errores:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('alojamientos.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre del alojamiento *</label>
                            <input type="text" name="nombre" class="form-control"
                                   value="{{ old('nombre') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipo de alojamiento *</label>
                            <select name="tipo" class="form-select" required>
                                <option value="">Selecciona un tipo</option>
                                <option value="hotel" {{ old('tipo') == 'hotel' ? 'selected' : '' }}>Hotel</option>
                                <option value="apartamento" {{ old('tipo') == 'apartamento' ? 'selected' : '' }}>Apartamento</option>
                                <option value="casa" {{ old('tipo') == 'casa' ? 'selected' : '' }}>Casa</option>
                                <option value="cabana" {{ old('tipo') == 'cabana' ? 'selected' : '' }}>Cabaña</option>
                                <option value="habitacion" {{ old('tipo') == 'habitacion' ? 'selected' : '' }}>Habitación</option>
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Dirección *</label>
                            <input type="text" name="direccion" class="form-control"
                                   value="{{ old('direccion') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ciudad *</label>
                            <input type="text" name="ciudad" class="form-control"
                                   value="{{ old('ciudad') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Precio por noche *</label>
                            <input type="number" name="precio_por_noche" class="form-control"
                                   value="{{ old('precio_por_noche') }}" min="0" step="0.01" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Capacidad de personas *</label>
                            <input type="number" name="capacidad" class="form-control"
                                   value="{{ old('capacidad') }}" min="1" max="65535" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Estado *</label>
                            <select name="estado" class="form-select" required>
                                <option value="disponible" {{ old('estado', 'disponible') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="no disponible" {{ old('estado') == 'no disponible' ? 'selected' : '' }}>No disponible</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">
                            Guardar alojamiento
                        </button>

                        <a href="{{ route('alojamientos.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </main>

</body>
</html>
