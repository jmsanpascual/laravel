<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Permission;

class PermissionController extends Controller
{
    public function index(Permission $permission)
    {
        return $permission->all();
    }
}
