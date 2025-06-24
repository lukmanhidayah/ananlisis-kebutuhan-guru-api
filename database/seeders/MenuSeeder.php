<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Role;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $home = Menu::firstOrCreate(['name' => 'Dashboard'], ['url' => '/dashboard']);
        $madrasah = Menu::firstOrCreate(['name' => 'Madrasah'], ['url' => '/madrasah']);
        $user = Menu::firstOrCreate(['name' => 'User'], ['url' => '/user']);
        $analisisMutasi = Menu::firstOrCreate(['name' => 'Analisis Mutasi'], ['url' => '/analisis-mutasi']);
        $rekapWilayah = Menu::firstOrCreate(['name' => 'Rekap Wilayah'], ['url' => '/recap-wilayah']);
        $rekapSemester = Menu::firstOrCreate(['name' => 'Rekap Semester'], ['url' => '/recap-semester']);

        foreach (Role::all() as $role) {
            // Sync menus with roles, avoiding duplicates
            // Using syncWithoutDetaching to avoid removing existing relationships
            // This will add the menus to the role without removing any existing ones
            // If you want to remove existing relationships, use sync() instead
            // but in this case, we want to keep existing relationships intact
            // This is useful when you want to add new menus without affecting existing ones
            $role->menus()->syncWithoutDetaching([
                $home->id,
                $madrasah->id,
                $user->id,
                $analisisMutasi->id,
                $rekapWilayah->id,
                $rekapSemester->id,
            ]);
        }
    }
}
