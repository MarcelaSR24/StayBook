<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StayBook | Encuentra tu próxima estadía</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary"><div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('home') }}">StayBook</a>
    <div class="d-flex gap-2">
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-outline-light">Mi panel</a>
            <form action="{{ route('logout') }}" method="POST">@csrf<button class="btn btn-light">Cerrar sesión</button></form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-light">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="btn btn-light">Crear cuenta</a>
        @endauth
    </div>
</div></nav>
<main class="container py-5">
    <div class="row align-items-center min-vh-50 g-4">
        <div class="col-lg-7">
            <span class="badge text-bg-primary mb-3">Hospedajes en StayBook</span>
            <h1 class="display-4 fw-bold">Encuentra un lugar para tu próxima estadía.</h1>
            <p class="lead text-secondary mt-3">Explora alojamientos, compara precios y reserva tus fechas con claridad.</p>
            <a href="{{ route('alojamientos.index') }}" class="btn btn-primary btn-lg mt-2">Explorar alojamientos</a>
        </div>
        <div class="col-lg-5"><div class="card shadow-sm"><div class="card-body p-4">
            <h2 class="h5">Reservas sencillas y transparentes</h2>
            <p class="text-secondary mb-0">Consulta las fechas, capacidad y precio antes de confirmar. El total se verifica nuevamente al registrar la reserva.</p>
        </div></div></div>
    </div>
</main>
</body>
</html>
