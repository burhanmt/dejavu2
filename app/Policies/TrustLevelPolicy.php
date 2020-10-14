<?php

namespace App\Policies;

use App\Models\TrustLevel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrustLevelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TrustLevel  $trustLevel
     * @return mixed
     */
    public function view(User $user, TrustLevel $trustLevel)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isPlatformAdmins() || $user->isPlatformModerator();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TrustLevel  $trustLevel
     * @return mixed
     */
    public function update(User $user, TrustLevel $trustLevel)
    {
        return $user->isPlatformStaff();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TrustLevel  $trustLevel
     * @return mixed
     */
    public function delete(User $user, TrustLevel $trustLevel)
    {
        return $user->isPlatformMaster();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TrustLevel  $trustLevel
     * @return mixed
     */
    public function restore(User $user, TrustLevel $trustLevel)
    {
        return $user->isPlatformAdmins() || $user->isPlatformModerator();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TrustLevel  $trustLevel
     * @return mixed
     */
    public function forceDelete(User $user, TrustLevel $trustLevel)
    {
        return $user->isPlatformMaster();
    }
}
