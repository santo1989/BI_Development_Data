<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ItemUmo;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemUmoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the itemUmo can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list itemumos');
    }

    /**
     * Determine whether the itemUmo can view the model.
     */
    public function view(User $user, ItemUmo $model): bool
    {
        return $user->hasPermissionTo('view itemumos');
    }

    /**
     * Determine whether the itemUmo can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create itemumos');
    }

    /**
     * Determine whether the itemUmo can update the model.
     */
    public function update(User $user, ItemUmo $model): bool
    {
        return $user->hasPermissionTo('update itemumos');
    }

    /**
     * Determine whether the itemUmo can delete the model.
     */
    public function delete(User $user, ItemUmo $model): bool
    {
        return $user->hasPermissionTo('delete itemumos');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete itemumos');
    }

    /**
     * Determine whether the itemUmo can restore the model.
     */
    public function restore(User $user, ItemUmo $model): bool
    {
        return false;
    }

    /**
     * Determine whether the itemUmo can permanently delete the model.
     */
    public function forceDelete(User $user, ItemUmo $model): bool
    {
        return false;
    }
}
