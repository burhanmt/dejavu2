<?php
/**
 * For role descriptions, look at "/config/roles.php" file.
 */
namespace App\Helpers;

trait UserRoleTraitHelper
{
    /**
     * @return bool
     */
    public function isCustomer(): bool
    {
        return $this->role === (int) config('roles.customer');
    }

    /**
     * @return bool
     */
    public function isPartnerModerator(): bool
    {
        return $this->role === (int) config('roles.partner-moderator');
    }

    /**
     * @return bool
     */
    public function isPartnerAdmin(): bool
    {
        return $this->role === (int) config('roles.partner-admin');
    }

    /**
     * @return bool
     */
    public function isPlatformEditor(): bool
    {
        return $this->role === (int) config('roles.platform-editor');
    }

    /**
     * @return bool
     */
    public function isPlatformModerator(): bool
    {
        return $this->role === (int) config('roles.platform-moderator');
    }

    /**
     * @return bool
     */
    public function isPlatformAdmin(): bool
    {
        return $this->role === (int) config('roles.platform-admin');
    }

    /**
     * @return bool
     */
    public function isPlatformMaster(): bool
    {
        return $this->role === (int) config('roles.platform-master');
    }

    /**
     * @return bool
     */
    public function isPlatformAdmins()
    {
        if (
            $this->role === (int) config('roles.platform-admin')
            || $this->role === (int) config('roles.platform-master')
        ) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isPlatformStaff()
    {
        if (
            $this->role === (int) config('roles.platform-admin')
            || $this->role === (int) config('roles.platform-master')
            || $this->role === (int) config('roles.platform-moderator')
            || $this->role === (int) config('roles.platform-editor')
        ) {
            return true;
        }
        return false;
    }

    public function isPartnerStaff()
    {
        if (
            $this->role === (int) config('roles.partner-admin')
            || $this->role === (int) config('roles.partner-moderator')
        ) {
            return true;
        }
        return false;
    }
}
