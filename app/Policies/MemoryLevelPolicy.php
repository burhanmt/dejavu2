<?php

namespace App\Policies;

use App\Models\MemoryLevel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemoryLevelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any memory levels.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the memory level.
     *
     * @param User $user
     * @param MemoryLevel $memoryLevel
     * @return bool
     */
    public function view(User $user, MemoryLevel $memoryLevel)
    {
        return true;
    }

    /**
     * Determine whether the user can create memory levels.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->isPlatformAdmins() || $user->isPlatformModerator();
    }

    /**
     * Determine whether the user can update the memory level.
     *
     * @param User $user
     * @param MemoryLevel $memoryLevel
     * @return bool
     */
    public function update(User $user, MemoryLevel $memoryLevel)
    {
        return $user->isPlatformStaff();
    }

    /**
     * Determine whether the user can delete the memory level.
     *
     * @param User $user
     * @param MemoryLevel $memoryLevel
     * @return bool
     */
    public function delete(User $user, MemoryLevel $memoryLevel)
    {
        return $user->isPlatformMaster();
    }

    /**
     * Determine whether the user can restore the memory level.
     *
     * @param User $user
     * @param MemoryLevel $memoryLevel
     * @return bool
     */
    public function restore(User $user, MemoryLevel $memoryLevel)
    {
        return $user->isPlatformAdmins() || $user->isPlatformModerator();
    }

    /**
     * Determine whether the user can permanently delete the memory level.
     *
     * @param User $user
     * @param MemoryLevel $memoryLevel
     * @return bool
     */
    public function forceDelete(User $user, MemoryLevel $memoryLevel)
    {
        return $user->isPlatformMaster();
    }
}