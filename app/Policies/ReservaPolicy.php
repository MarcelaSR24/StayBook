<?php

namespace App\Policies;

use App\Models\Reserva;
use App\Models\User;

class ReservaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isRole(User::ROLE_CLIENT, User::ROLE_OWNER, User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Reserva $reserva): bool
    {
        return $user->isRole(User::ROLE_ADMIN)
            || ($user->isRole(User::ROLE_CLIENT) && $reserva->user_id === $user->id)
            || ($user->isRole(User::ROLE_OWNER) && $reserva->alojamiento?->user_id === $user->id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isRole(User::ROLE_CLIENT);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Reserva $reserva): bool
    {
        return $user->isRole(User::ROLE_ADMIN)
            || ($user->isRole(User::ROLE_CLIENT) && $reserva->user_id === $user->id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Reserva $reserva): bool
    {
        return $this->update($user, $reserva);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Reserva $reserva): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Reserva $reserva): bool
    {
        return false;
    }

    public function confirm(User $user, Reserva $reserva): bool
    {
        return $reserva->estado === 'pendiente'
            && ($user->isRole(User::ROLE_ADMIN)
                || ($user->isRole(User::ROLE_OWNER) && $reserva->alojamiento?->user_id === $user->id));
    }
}
