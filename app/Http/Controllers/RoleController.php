<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Role;

class RoleController extends Controller
{
    public function index(Role $role)
    {
        return $role->all();
    }
}
