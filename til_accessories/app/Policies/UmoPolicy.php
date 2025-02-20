<?php

namespace App\Policies;

use App\Models\Umo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UmoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the umo can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list umos');
    }

    /**
     * Determine whether the umo can view the model.
     */
    public function view(User $user, Umo $model): bool
    {
        return $user->hasPermissionTo('view umos');
    }

    /**
     * Determine whether the umo can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create umos');
    }

    /**
     * Determine whether the umo can update the model.
     */
    public function update(User $user, Umo $model): bool
    {
        return $user->hasPermissionTo('update umos');
    }

    /**
     * Determine whether the umo can delete the model.
     */
    public function delete(User $user, Umo $model): bool
    {
        return $user->hasPermissionTo('delete umos');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete umos');
    }

    /**
     * Determine whether the umo can restore the model.
     */
    public function restore(User $user, Umo $model): bool
    {
        return false;
    }

    /**
     * Determine whether the umo can permanently delete the model.
     */
    public function forceDelete(User $user, Umo $model): bool
    {
        return false;
    }
}
