<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VillageSeeder extends Seeder
{
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/villages.json'));
        $villages = json_decode($json, true);

        $districts = DB::table('districts')->pluck('id')->toArray();

        $villages = array_filter($villages, function ($village) use ($districts) {
            return isset($village['district_id']) && in_array($village['district_id'], $districts);
        });

        if (is_null($villages)) {
            throw new \Exception('Invalid JSON format in villages.json');
        }

        foreach ($villages as $village) {
            DB::table('villages')->updateOrInsert(
                ['id' => $village['id']],
                [
                    'name' => $village['name'],
                    'district_id' => $village['district_id'],
                    'latitude' => $village['latitude'],
                    'longitude' => $village['longitude'],
                    'created_by' => 'system',
                ]
            );
        }
    }
}
