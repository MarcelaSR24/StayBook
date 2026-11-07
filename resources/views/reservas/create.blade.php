
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva reserva | StayBook</title>

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

                        <h1 class="h3 mb-2">Nueva reserva</h1>

                        <p class="text-muted mb-4">
                            Completa los datos para reservar tu alojamiento.
                        </p>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if($alojamientos->isEmpty())

                            <div class="alert alert-warning">
                                Actualmente no hay alojamientos disponibles para reservar.
                            </div>

                            <a href="{{ route('alojamientos.index') }}" class="btn btn-secondary">
                                Volver a alojamientos
                            </a>

                        @else

                            <form action="{{ route('reservas.store') }}" method="POST">

                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">
                                        Seleccionar alojamiento
                                    </label>

                                    <select name="alojamiento_id" id="alojamiento_id"
                                            class="form-select" required>

                                        <option value="">Selecciona un alojamiento</option>

                                        @foreach($alojamientos as $alojamiento)
                                            <option
                                                value="{{ $alojamiento->id }}"
                                                data-precio="{{ $alojamiento->precio_por_noche }}"
                                                data-capacidad="{{ $alojamiento->capacidad }}"
                                                {{ old('alojamiento_id', request('alojamiento_id')) == $alojamiento->id ? 'selected' : '' }}>
                                                {{ $alojamiento->nombre }} -
                                                {{ $alojamiento->ciudad }} -
                                                ${{ number_format($alojamiento->precio_por_noche, 0, ',', '.') }} por noche
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">
                                        Fecha de entrada
                                    </label>

                                    <input type="date"
                                           name="fecha_entrada"
                                           id="fecha_entrada"
                                           class="form-control"
                                           value="{{ old('fecha_entrada') }}"
                                           min="{{ now()->format('Y-m-d') }}"
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">
                                        Fecha de salida
                                    </label>

                                    <input type="date"
                                           name="fecha_salida"
                                           id="fecha_salida"
                                           class="form-control"
                                           value="{{ old('fecha_salida') }}"
                                           min="{{ now()->addDay()->format('Y-m-d') }}"
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">
                                        Cantidad de huéspedes
                                    </label>

                                    <input type="number"
                                           name="cantidad_huespedes"
                                           id="cantidad_huespedes"
                                           class="form-control"
                                           value="{{ old('cantidad_huespedes', 1) }}"
                                           min="1"
                                           required>

                                    <small class="text-muted" id="capacidad">
                                        Selecciona un alojamiento para consultar su capacidad.
                                    </small>
                                </div>

                                <div class="alert alert-info" aria-live="polite">
                                    <strong>Resumen estimado</strong>
                                    <dl class="row mb-1 mt-2">
                                        <dt class="col-7">Entrada</dt><dd class="col-5" id="resumen_entrada">—</dd>
                                        <dt class="col-7">Salida</dt><dd class="col-5" id="resumen_salida">—</dd>
                                        <dt class="col-7">Noches</dt><dd class="col-5" id="resumen_noches">0</dd>
                                        <dt class="col-7">Precio por noche</dt><dd class="col-5" id="resumen_precio_noche">$0</dd>
                                        <dt class="col-7">Precio total</dt><dd class="col-5 fw-bold" id="precio_total">$0</dd>
                                    </dl>
                                    <p class="mb-0 small">El servidor volverá a calcular el precio al confirmar.</p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('reservas.index') }}"
                                       class="btn btn-outline-secondary">
                                        Volver
                                    </a>

                                    <button type="submit" class="btn btn-primary">
                                        Registrar reserva
                                    </button>
                                </div>

                            </form>

                        @endif

                    </div>
                </div>

            </div>
        </div>

    </main>

    <script>
        const alojamiento = document.getElementById('alojamiento_id');
        const entrada = document.getElementById('fecha_entrada');
        const salida = document.getElementById('fecha_salida');
        const huespedes = document.getElementById('cantidad_huespedes');
        const precioTotal = document.getElementById('precio_total');
        const capacidadTexto = document.getElementById('capacidad');
        const resumenEntrada = document.getElementById('resumen_entrada');
        const resumenSalida = document.getElementById('resumen_salida');
        const resumenNoches = document.getElementById('resumen_noches');
        const resumenPrecioNoche = document.getElementById('resumen_precio_noche');
        const formatoPrecio = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP', maximumFractionDigits: 0 });

        function formatoFecha(valor) {
            if (!valor) return '—';
            const [anio, mes, dia] = valor.split('-').map(Number);
            return new Intl.DateTimeFormat('es-CO').format(new Date(anio, mes - 1, dia));
        }

        function calcularPrecio() {
            if (!alojamiento || !entrada || !salida) {
                return;
            }

            const opcion = alojamiento.options[alojamiento.selectedIndex];

            const precio = Number(opcion.dataset.precio || 0);
            const capacidad = Number(opcion.dataset.capacidad || 0);
            resumenEntrada.textContent = formatoFecha(entrada.value);
            resumenSalida.textContent = formatoFecha(salida.value);
            resumenPrecioNoche.textContent = formatoPrecio.format(precio);

            capacidadTexto.textContent = capacidad
                ? `Capacidad máxima: ${capacidad} personas.`
                : 'Selecciona un alojamiento para consultar su capacidad.';

            if (capacidad) {
                huespedes.max = capacidad;
            } else {
                huespedes.removeAttribute('max');
            }

            if (entrada.value && salida.value && precio >= 0) {
                const fechaEntrada = new Date(entrada.value + 'T00:00:00');
                const fechaSalida = new Date(salida.value + 'T00:00:00');

                const diferencia = fechaSalida - fechaEntrada;
                const noches = diferencia / (1000 * 60 * 60 * 24);

                if (noches > 0) {
                    const total = noches * precio;
                    resumenNoches.textContent = String(noches);
                    precioTotal.textContent = formatoPrecio.format(total);
                    return;
                }
            }

            resumenNoches.textContent = '0';
            precioTotal.textContent = formatoPrecio.format(0);
        }

        alojamiento?.addEventListener('change', calcularPrecio);
        entrada?.addEventListener('change', () => {
            if (entrada.value) {
                const diaSiguiente = new Date(entrada.value + 'T00:00:00');
                diaSiguiente.setDate(diaSiguiente.getDate() + 1);
                salida.min = `${diaSiguiente.getFullYear()}-${String(diaSiguiente.getMonth() + 1).padStart(2, '0')}-${String(diaSiguiente.getDate()).padStart(2, '0')}`;
                if (salida.value && salida.value <= entrada.value) {
                    salida.value = '';
                }
            }

            calcularPrecio();
        });

        salida?.addEventListener('change', calcularPrecio);
        huespedes?.addEventListener('input', calcularPrecio);

        calcularPrecio();
    </script>

</body>
</html>
