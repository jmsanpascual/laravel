<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRegionAccess extends Model
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

    // Build and return a database insertable array of object from an
    // array of objects with extra properties
    public function buildPermissions($userId, $regionPermissionsArr)
    {
        $result = [];
        $now = \DB::raw('CURRENT_TIMESTAMP');

        foreach($regionPermissionsArr as $key => $region) {
            // Assign the neccessary fields
            $temp = [
                'user_id' => $userId,
                'region_id' => $region['id'],
                'permission' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            // Sum the permission bit
            foreach($region['permissions'] as $key => $permission) {
                $temp['permission'] += $permission['bit'];
            }

            array_push($result, $temp);
        }

        return $result;
    }
}
