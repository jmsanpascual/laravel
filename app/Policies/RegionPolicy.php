<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Region;
use App\User;

class RegionPolicy
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

    public function store(User $user, Region $region)
    {
        $regionId = $region->id;

        return $this->userPermissions[$regionId] & $this->permissions['ADD'];
    }
}
