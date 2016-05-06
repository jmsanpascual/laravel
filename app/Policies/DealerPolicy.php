<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Dealer;
use App\User;

class DealerPolicy
{
    use HandlesAuthorization;

    protected $userPermissions;
    protected $permissions;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userPermissions = session()->get('permissions');
        $this->permissions = config('constants.PERMISSIONS');
    }

    public function update(User $user, Dealer $dealer)
    {
        $regionId = $dealer->region_id;

        return $this->userPermissions[$regionId] & $this->permissions['EDIT'];
    }

    public function delete(User $user, Dealer $dealer)
    {
        $regionId = $dealer->region_id;

        return $this->userPermissions[$regionId] & $this->permissions['DELETE'];
    }
}
