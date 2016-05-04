<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Build and return a sync insertable array of object from an
    // array of objects, format: [region_id => ['permission' => permissionSum]]
    public function scopeBuildPermissions($query, $regionPermissionsArr)
    {
        $result = [];

        foreach($regionPermissionsArr as $key => $region) {
            $permissions = 0;

            // Sum the permission bit
            foreach($region['permissions'] as $key => $permission) {
                $permissions += $permission['bit'];
            }

            $result[$region['id']] = ['permission' => $permissions];
        }

        return $result;
    }
}
