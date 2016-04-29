<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Region;

class RegionController extends Controller
{
    public function index(Region $region)
    {
        return $region->all();
    }
}
