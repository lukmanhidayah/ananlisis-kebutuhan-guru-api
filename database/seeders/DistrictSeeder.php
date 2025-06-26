<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/districts.json'));
        $districts = json_decode($json, true);

        $regencies = DB::table('regencies')->pluck('id')->toArray();

        $districts = array_filter($districts, function ($district) use ($regencies) {
            return isset($district['regency_id']) && in_array($district['regency_id'], $regencies);
        });

        if (is_null($districts)) {
            throw new \Exception('Invalid JSON format in districts.json');
        }

        foreach ($districts as $district) {
            DB::table('districts')->updateOrInsert(
                ['id' => $district['id']],
                [
                    'name' => $district['name'],
                    'regency_id' => $district['regency_id'],
                    'latitude' => $district['latitude'],
                    'longitude' => $district['longitude'],
                    'created_by' => 'system',
                ]
            );
        }
    }
}
