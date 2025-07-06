<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_id' => Str::uuid(),
            'name' => 'John doe',
            'email' => 'johndoe@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);

    }
}
