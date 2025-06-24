<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Role;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Role::all() as $role) {
            Menu::firstOrCreate(
                ['role_id' => $role->id, 'name' => 'Home'],
                ['url' => '/home']
            );
            Menu::firstOrCreate(
                ['role_id' => $role->id, 'name' => 'Profile'],
                ['url' => '/profile']
            );
        }
    }
}
