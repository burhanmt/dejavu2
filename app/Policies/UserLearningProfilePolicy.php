<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserLearningProfile;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserLearningProfilePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any user learning profiles.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the user learning profile.
     *
     * @param User $user
     * @param UserLearningProfile $userLearningProfile
     * @return bool
     */
    public function view(User $user, UserLearningProfile $userLearningProfile)
    {
        return true;
    }

    /**
     * Determine whether the user can create user learning profiles.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the user learning profile.
     *
     * @param User $user
     * @param UserLearningProfile $userLearningProfile
     * @return bool
     */
    public function update(User $user, UserLearningProfile $userLearningProfile)
    {
        return $user->isPlatformAdmins() || ($userLearningProfile->id === $user ->id);
    }

    /**
     * Determine whether the user can delete the user learning profile.
     *
     * @param User $user
     * @param UserLearningProfile $userLearningProfile
     * @return bool
     */
    public function delete(User $user, UserLearningProfile $userLearningProfile)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the user learning profile.
     *
     * @param User $user
     * @param UserLearningProfile $userLearningProfile
     * @return bool
     */
    public function restore(User $user, UserLearningProfile $userLearningProfile)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the user learning profile.
     *
     * @param User $user
     * @param UserLearningProfile $userLearningProfile
     * @return bool
     */
    public function forceDelete(User $user, UserLearningProfile $userLearningProfile)
    {
        return false;
    }
}
