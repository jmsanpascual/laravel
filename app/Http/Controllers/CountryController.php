<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Country;

class CountryController extends Controller
{
    function index(Country $country)
    {
        return $country->all();
    }
}
