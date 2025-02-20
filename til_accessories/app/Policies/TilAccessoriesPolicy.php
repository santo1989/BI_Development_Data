<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TilAccessories;
use Illuminate\Auth\Access\HandlesAuthorization;

class TilAccessoriesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the tilAccessories can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list tilaccessories');
    }

    /**
     * Determine whether the tilAccessories can view the model.
     */
    public function view(User $user, TilAccessories $model): bool
    {
        return $user->hasPermissionTo('view tilaccessories');
    }

    /**
     * Determine whether the tilAccessories can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create tilaccessories');
    }

    /**
     * Determine whether the tilAccessories can update the model.
     */
    public function update(User $user, TilAccessories $model): bool
    {
        return $user->hasPermissionTo('update tilaccessories');
    }

    /**
     * Determine whether the tilAccessories can delete the model.
     */
    public function delete(User $user, TilAccessories $model): bool
    {
        return $user->hasPermissionTo('delete tilaccessories');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete tilaccessories');
    }

    /**
     * Determine whether the tilAccessories can restore the model.
     */
    public function restore(User $user, TilAccessories $model): bool
    {
        return false;
    }

    /**
     * Determine whether the tilAccessories can permanently delete the model.
     */
    public function forceDelete(User $user, TilAccessories $model): bool
    {
        return false;
    }
}
