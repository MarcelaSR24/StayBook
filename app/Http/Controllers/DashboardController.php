<?php

namespace App\Http\Controllers;

use App\Models\Alojamiento;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();
        $stats = $user->isRole(User::ROLE_ADMIN) ? [
            'usuarios' => User::count(),
            'alojamientos' => Alojamiento::count(),
            'reservas' => Reserva::count(),
        ] : [];

        return view('dashboard', compact('user', 'stats'));
    }
}
