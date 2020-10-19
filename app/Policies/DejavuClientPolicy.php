<?php

namespace App\Policies;

use App\Models\DejavuClient;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DejavuClientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any dejavu clients.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->isPlatformStaff() || $user->isPartnerStaff();
    }

    /**
     * Determine whether the user can view the dejavu client.
     *
     * @param User $user
     * @param DejavuClient $dejavuClient
     * @return bool
     */
    public function view(User $user, DejavuClient $dejavuClient)
    {
        return $user->isPlatformStaff() || $user->isPartnerStaff();
    }

    /**
     * Determine whether the user can create dejavu clients.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->isPlatformStaff();
    }

    /**
     * Determine whether the user can update the dejavu client.
     *
     * @param User $user
     * @param DejavuClient $dejavuClient
     * @return bool
     */
    public function update(User $user, DejavuClient $dejavuClient)
    {
        return $user->isPlatformStaff();
    }

    /**
     * Determine whether the user can delete the dejavu client.
     *
     * @param User $user
     * @param DejavuClient $dejavuClient
     * @return bool
     */
    public function delete(User $user, DejavuClient $dejavuClient)
    {
        return $user->isPlatformMaster();
    }

    /**
     * Determine whether the user can restore the dejavu client.
     *
     * @param User $user
     * @param DejavuClient $dejavuClient
     * @return bool
     */
    public function restore(User $user, DejavuClient $dejavuClient)
    {
        return $user->isPlatformAdmins() || $user->isPlatformModerator();
    }

    /**
     * Determine whether the user can permanently delete the dejavu client.
     *
     * @param User $user
     * @param DejavuClient $dejavuClient
     * @return bool
     */
    public function forceDelete(User $user, DejavuClient $dejavuClient)
    {
        return $user->isPlatformMaster();
    }
}
