<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view any users.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param User $user
     * @param User $user
     * @return bool
     */
    public function view(User $user, User $attemptToAccessUser)
    {
        return ($user->id == $attemptToAccessUser->id) || $user->isPartnerStaff() || $user->isPlatformStaff();
    }

    /**
     * Determine whether the user can create users.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->isPlatformStaff() || $user->isPartnerModerator() || $user->isPartnerAdmin();
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param User $user
     * @param User $attemptToAccessUser
     * @return bool
     */
    public function update(User $user, User $attemptToAccessUser)
    {
        return ($user->id == $attemptToAccessUser->id) || $user->isPartnerStaff() || $user->isPlatformAdmins() || $user->isPlatformModerator();
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param User $user
     * @param User $user2
     * @return bool
     */
    public function delete(User $user, User $user2)
    {
        return $user->isPlatformMaster();
    }

    /**
     * Determine whether the user can restore the user.
     *
     * @param User $user
     * @param User $user2
     * @return bool
     */
    public function restore(User $user, User $user2)
    {
        return $user->isPlatformAdmins() || $user->isPlatformModerator();
    }

    /**
     * Determine whether the user can permanently delete the user.
     *
     * @param User $user
     * @param User $user2
     * @return bool
     */
    public function forceDelete(User $user, User $user2)
    {
        return $user->isPlatformMaster();
    }
}
