<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any user profiles.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the user profile.
     *
     * @param User $user
     * @param UserProfile $userProfile
     * @return bool
     */
    public function view(User $user, UserProfile $userProfile)
    {
        return true;
    }

    /**
     * Determine whether the user can create user profiles.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the user profile.
     *
     * @param User $user
     * @param UserProfile $userProfile
     * @return bool
     */
    public function update(User $user, UserProfile $userProfile)
    {
        //
    }

    /**
     * Determine whether the user can delete the user profile.
     *
     * @param User $user
     * @param UserProfile $userProfile
     * @return bool
     */
    public function delete(User $user, UserProfile $userProfile)
    {
        //
    }

    /**
     * Determine whether the user can restore the user profile.
     *
     * @param User $user
     * @param UserProfile $userProfile
     * @return bool
     */
    public function restore(User $user, UserProfile $userProfile)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the user profile.
     *
     * @param User $user
     * @param UserProfile $userProfile
     * @return bool
     */
    public function forceDelete(User $user, UserProfile $userProfile)
    {
        //
    }
}
