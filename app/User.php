<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function regions()
    {
        return $this->hasMany('App\UserRegionAccess');
    }

    public function getUserWithRole()
    {
        return $this->where('id', $this->id)->with('role')->first();
    }
}
