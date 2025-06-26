<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegencySeeder extends Seeder
{
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/regencies.json'));
        $regencies = json_decode($json, true);
        
        $regencies = array_filter($regencies, function ($regency) {
            return isset($regency['province_id']) && $regency['province_id'] === '32';
        });

        // remove province_id from each regency
        $regencies = array_map(function ($regency) {
            unset($regency['province_id']);
            return $regency;
        }, $regencies);

        if (is_null($regencies)) {
            throw new \Exception('Invalid JSON format in regencies.json');
        }

        foreach ($regencies as $regency) {
            DB::table('regencies')->updateOrInsert(
                ['id' => $regency['id']],
                [
                    'name' => $regency['name'],
                    'latitude' => $regency['latitude'],
                    'longitude' => $regency['longitude'],
                    'created_by' => 'system',
                ]
            );
        }
    }
}
