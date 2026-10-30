
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlojamientoController;

Route::get('/', function () {
    return redirect()->route('alojamientos.index');
});

Route::resource('alojamientos', AlojamientoController::class);
