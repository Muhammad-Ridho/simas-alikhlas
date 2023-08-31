<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

use App\Models\Asset;

class AssetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Asset $asset)
    {
        return true;
        // return $user->hasRole('admin') || $user->hasRole('manager');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Asset $asset)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Asset $asset)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Asset $asset)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Asset $asset)
    {
        return true;
    }
}
