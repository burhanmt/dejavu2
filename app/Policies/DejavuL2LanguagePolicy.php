<?php

namespace App\Policies;

use App\Models\DejavuL2Language;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DejavuL2LanguagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any dejavu l2 languages.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view any dejavu l2 languages.
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user, DejavuL2Language $dejavuL2Language)
    {
        return true;
    }

    /**
     * Determine whether the user can create dejavu l2 languages.
     * Only Platform admins can create it. (Admin and master)
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->isPlatformAdmins() || $user->isPlatformModerator();
    }

    /**
     * Determine whether the user can update the dejavu l2 language.
     *
     * @param User $user
     * @param DejavuL2Language $dejavuL2Language
     * @return bool
     */
    public function update(User $user, DejavuL2Language $dejavuL2Language)
    {
        return $user->isPlatformStaff();
    }

    /**
     * Determine whether the user can delete the dejavu l2 language.
     *
     * @param User $user
     * @param DejavuL2Language $dejavuL2Language
     * @return bool
     */
    public function delete(User $user, DejavuL2Language $dejavuL2Language)
    {
        $user->isPlatformMaster();
    }

    /**
     * Determine whether the user can restore the dejavu l2 language.
     *
     * @param User $user
     * @param DejavuL2Language $dejavuL2Language
     * @return bool
     */
    public function restore(User $user, DejavuL2Language $dejavuL2Language)
    {
        return $user->isPlatformAdmins() || $user->isPlatformModerator();
    }

    /**
     * Determine whether the user can permanently delete the dejavu l2 language.
     *
     * @param User $user
     * @param DejavuL2Language $dejavuL2Language
     * @return bool
     */
    public function forceDelete(User $user, DejavuL2Language $dejavuL2Language)
    {
        $user->isPlatformMaster();
    }
}
