<?php

namespace App\Policies;

use App\Models\DejavuL1Language;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DejavuL1LanguagePolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view any dejavu l1 languages.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the dejavu l1 language.
     *
     * @param User $user
     * @param DejavuL1Language $dejavuL1Language
     * @return bool
     */
    public function view(User $user, DejavuL1Language $dejavuL1Language)
    {
        return true;
    }

    /**
     * Determine whether the user can create dejavu l1 languages.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the dejavu l1 language.
     *
     * @param User $user
     * @param DejavuL1Language $dejavuL1Language
     * @return bool
     */
    public function update(User $user, DejavuL1Language $dejavuL1Language)
    {
        //
    }

    /**
     * Determine whether the user can delete the dejavu l1 language.
     *
     * @param User $user
     * @param DejavuL1Language $dejavuL1Language
     * @return bool
     */
    public function delete(User $user, DejavuL1Language $dejavuL1Language)
    {
        //
    }

    /**
     * Determine whether the user can restore the dejavu l1 language.
     *
     * @param User $user
     * @param DejavuL1Language $dejavuL1Language
     * @return bool
     */
    public function restore(User $user, DejavuL1Language $dejavuL1Language)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the dejavu l1 language.
     *
     * @param User $user
     * @param DejavuL1Language $dejavuL1Language
     * @return bool
     */
    public function forceDelete(User $user, DejavuL1Language $dejavuL1Language)
    {
        //
    }
}