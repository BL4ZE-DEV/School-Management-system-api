<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = Role::where('name' , 'Super Admin')->first();
        $manager = Role::where('name', 'Manager')->first();

        $permissions = Permission::pluck('id', 'name');

        $superadmin->permissions()->sync($permissions->values());


        $manager->permissions()->sync([
            $permissions['view_reports'],
            $permissions['manage_visitors'],
            $permissions['manage_estates'],
        ]);
    }
}
 