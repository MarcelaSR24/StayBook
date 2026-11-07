<?php

namespace App\Policies;

use App\Models\Alojamiento;
use App\Models\User;

class AlojamientoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isRole(User::ROLE_OWNER, User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Alojamiento $alojamiento): bool
    {
        return $user->isRole(User::ROLE_ADMIN)
            || ($user->isRole(User::ROLE_OWNER) && $alojamiento->user_id === $user->id)
            || ($alojamiento->estado === 'disponible' && $alojamiento->user_id !== null);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isRole(User::ROLE_OWNER);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Alojamiento $alojamiento): bool
    {
        return $user->isRole(User::ROLE_ADMIN)
            || ($user->isRole(User::ROLE_OWNER) && $alojamiento->user_id === $user->id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Alojamiento $alojamiento): bool
    {
        return $this->update($user, $alojamiento);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Alojamiento $alojamiento): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Alojamiento $alojamiento): bool
    {
        return false;
    }
}
