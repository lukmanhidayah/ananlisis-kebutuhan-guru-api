<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::where('name', 'Kantor Wilayah')->first();
        if (!$role) {
            $role = Role::create(['name' => 'Kantor Wilayah']);
        }

        User::firstOrCreate(
            ['email' => 'lukmanhidayah01@gmail.com'],
            [
                'name' => 'Lukman Hidayah',
                'password' => Hash::make('password'),
                'status' => true,
                'role_id' => $role->id,
            ]
        );
    }
}
