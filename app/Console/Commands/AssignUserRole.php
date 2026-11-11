<?php

namespace App\Console\Commands;

use App\Models\Alojamiento;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('staybook:assign-role {email} {role : client, owner or admin}')]
#[Description('Assigns a StayBook role to an existing account from the server console.')]
class AssignUserRole extends Command
{
    public function handle(): int
    {
        $role = (string) $this->argument('role');

        if (! in_array($role, [User::ROLE_CLIENT, User::ROLE_OWNER, User::ROLE_ADMIN], true)) {
            $this->error('Role must be client, owner or admin.');

            return self::FAILURE;
        }

        $user = User::withTrashed()->where('email', $this->argument('email'))->first();

        if ($user === null) {
            $this->error('No account exists with that email address.');

            return self::FAILURE;
        }

        if ($user->role === User::ROLE_ADMIN && $role !== User::ROLE_ADMIN
            && User::where('role', User::ROLE_ADMIN)->count() <= 1) {
            $this->error('The last administrator cannot be demoted.');

            return self::FAILURE;
        }

        if ($user->isRole(User::ROLE_OWNER, User::ROLE_ADMIN)
            && $role === User::ROLE_CLIENT
            && Alojamiento::where('user_id', $user->id)->exists()) {
            $this->error('Reassign or archive the account’s accommodations before demoting it to client.');

            return self::FAILURE;
        }

        $user->forceFill(['role' => $role])->save();
        $this->info("Assigned role {$role} to {$user->email}.");

        return self::SUCCESS;
    }
}
