<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alojamiento;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', ['users' => User::withTrashed()->latest()->paginate(20)]);
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'role' => ['required', Rule::in([User::ROLE_CLIENT, User::ROLE_OWNER, User::ROLE_ADMIN])],
        ]);

        if ($user->is($request->user()) && $data['role'] !== $user->role) {
            return back()->withErrors(['role' => 'No puedes cambiar tu propio rol.']);
        }

        if ($user->role === User::ROLE_ADMIN && $data['role'] !== User::ROLE_ADMIN
            && User::where('role', User::ROLE_ADMIN)->count() <= 1) {
            return back()->withErrors(['role' => 'Debe permanecer al menos un administrador.']);
        }

        if ($user->isRole(User::ROLE_OWNER, User::ROLE_ADMIN)
            && $data['role'] === User::ROLE_CLIENT
            && Alojamiento::where('user_id', $user->id)->exists()) {
            return back()->withErrors(['role' => 'Reasigna o archiva los alojamientos antes de cambiar este perfil a cliente.']);
        }

        $user->forceFill(['role' => $data['role']])->save();

        return back()->with('success', 'Rol actualizado correctamente.');
    }
}
