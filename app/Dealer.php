<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'region_id',
        'city',
        'province',
        'contact_person',
        'contact_number',
        'address_line_1',
        'address_line_2',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'created_at',
      'updated_at',
    ];

    public function region()
    {
        return $this->belongsTo('App\Region');
    }
}
