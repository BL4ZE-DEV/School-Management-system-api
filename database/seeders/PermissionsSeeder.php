<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'manage_users'],
            ['name' => 'view_reports'],
            ['name' => 'manage_estates'],
            ['name' => 'create_tenant'],
            ['name' => 'manage_visitors'],

        ];

        foreach ($permissions as $permission){
            Permission::create([$permission]);
        }
    }
}
