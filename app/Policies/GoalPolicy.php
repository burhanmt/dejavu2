<?php

namespace App\Policies;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GoalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any goals.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the goal.
     *
     * @param User $user
     * @param Goal $goal
     * @return bool
     */
    public function view(User $user, Goal $goal)
    {
        return true;
    }

    /**
     * Determine whether the user can create goals.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->isPlatformAdmins() || $user->isPlatformModerator();
    }

    /**
     * Determine whether the user can update the goal.
     *
     * @param User $user
     * @param Goal $goal
     * @return bool
     */
    public function update(User $user, Goal $goal)
    {
        return $user->isPlatformStaff();
    }

    /**
     * Determine whether the user can delete the goal.
     *
     * @param User $user
     * @param Goal $goal
     * @return bool
     */
    public function delete(User $user, Goal $goal)
    {
        return $user->isPlatformMaster();
    }

    /**
     * Determine whether the user can restore the goal.
     *
     * @param User $user
     * @param Goal $goal
     * @return bool
     */
    public function restore(User $user, Goal $goal)
    {
        return $user->isPlatformAdmins() || $user->isPlatformModerator();
    }

    /**
     * Determine whether the user can permanently delete the goal.
     *
     * @param User $user
     * @param Goal $goal
     * @return bool
     */
    public function forceDelete(User $user, Goal $goal)
    {
        return $user->isPlatformMaster();
    }
}
