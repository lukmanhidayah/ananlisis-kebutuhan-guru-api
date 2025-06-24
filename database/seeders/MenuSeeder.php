<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Role;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $home = Menu::firstOrCreate(['name' => 'Home'], ['url' => '/home']);
        $profile = Menu::firstOrCreate(['name' => 'Profile'], ['url' => '/profile']);

        foreach (Role::all() as $role) {
            $role->menus()->syncWithoutDetaching([$home->id, $profile->id]);
        }
    }
}
