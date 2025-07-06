<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'subdomain' => 'required|unique:tenants,subdomain',
            'location' => 'required|string',
            'school_name' => 'required|string',
        ]);

        DB::beginTransaction();

        try{
            $ManagerRole = Role::where('name', 'manager')->first();

            $user = User::create([
                'user_id' => Str::uuid(),
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $ManagerRole->id
            ]);

            if(!$user){
                return response()->json([
                    'error' => 'Unable to create user'
                ]);
            }

            DB::commit();

            $exitcode = Artisan::call('tenant:create', [
                'school_name' => $request->school_name,
                'subdomain' => $request->subdomain,
                'location' => $request->location,
                '--manager' => $user->user_id
            ]);

            if($exitcode !== 0){
                throw new \Exception('Tenant creation failed');
            }

            return response()->json([
                'message' => 'School regisrterd succesfully',
                'manger' => $user
            ]);
        }catch(\Exception $e){
            if(DB::transactionLevel() > 0){
                DB::rollBack();
            }
            return response()->json([
                'error' => 'failed to register School',
                'details' => $e->getMessage()
            ]);
        }
    }
}
