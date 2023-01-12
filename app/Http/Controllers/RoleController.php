<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $data['roles'] = Role::query()->get(["name", "id"]);

        return view('auth.roles', [
            'roles' => $data['roles'],
        ]);
    }


    public function fetchRoles(Request $request)
    {
        $data['roles'] = Role::query()->get(["name", "id"]);
        return response()->json($data);
    }
}
