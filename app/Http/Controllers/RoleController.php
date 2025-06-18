<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Http\Requests\StoreroleRequest;
use App\Http\Requests\UpdateroleRequest;

class RoleController extends Controller
{
    public function Store(StoreroleRequest $request){
        $role = Role::create([
            'name' => $request->name
        ]);
    }
}
