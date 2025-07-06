<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

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

            $token = JWTAuth::fromUser($user);

            return response()->json([
                'message' => 'School regisrterd succesfully',
                'token' => $token,
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


    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $cridentials  = $request->only('email', 'password');

        if(!$token = JWTAuth::attempt($cridentials)){
            return response()->json([
                'status' => 'Error',
                'message' => 'incorrect credentials or something along that line'
            ],401);
        }

        $user = auth()->user();

        $tenant = Tenant::where('manager_id', $user->user_id)->firstOrFail();

        if(!$tenant){
            return "hello super admin";
        }
        try {
            config(['database.connections.tenants.database' => $tenant->database]);
            DB::purge('tenants');
            DB::reconnect('tenants');
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
      

        return response()->json([
            'token' => $token,
            'message' => 'welcome '. $user->name. ' database for '.(  $tenant ? $tenant->database. 'has been loaded' : "no db found"),
            'tenant' =>$tenant
        ]);

    }

    public function logout(){

    }
}
