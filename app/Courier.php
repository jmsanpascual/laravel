<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'account_number',
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

    protected $casts = [
        'template_fields' => 'array',
    ];
}
