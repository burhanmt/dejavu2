<?php

namespace App\Policies;

use App\Models\Interest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InterestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any interests.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the interest.
     *
     * @param User $user
     * @param Interest $interest
     * @return bool
     */
    public function view(User $user, Interest $interest)
    {
        return true;
    }

    /**
     * Determine whether the user can create interests.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->isPlatformAdmins() || $user->isPlatformModerator();
    }

    /**
     * Determine whether the user can update the interest.
     *
     * @param User $user
     * @param Interest $interest
     * @return bool
     */
    public function update(User $user, Interest $interest)
    {
        return $user->isPlatformStaff();
    }

    /**
     * Determine whether the user can delete the interest.
     *
     * @param User $user
     * @param Interest $interest
     * @return bool
     */
    public function delete(User $user, Interest $interest)
    {
        return $user->isPlatformMaster();
    }

    /**
     * Determine whether the user can restore the interest.
     *
     * @param User $user
     * @param Interest $interest
     * @return bool
     */
    public function restore(User $user, Interest $interest)
    {
        return $user->isPlatformAdmins() || $user->isPlatformModerator();
    }

    /**
     * Determine whether the user can permanently delete the interest.
     *
     * @param User $user
     * @param Interest $interest
     * @return bool
     */
    public function forceDelete(User $user, Interest $interest)
    {
        return $user->isPlatformMaster();
    }
}
