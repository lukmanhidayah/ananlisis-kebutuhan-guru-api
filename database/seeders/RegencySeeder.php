<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegencySeeder extends Seeder
{
    public function run(): void
    {
        $regencies = [
            ["id" => 3201, "name" => "KABUPATEN BOGOR", "latitude" => -6.58333, "longitude" => 106.71667],
            ["id" => 3202, "name" => "KABUPATEN SUKABUMI", "latitude" => -7.06667, "longitude" => 106.7],
            ["id" => 3203, "name" => "KABUPATEN CIANJUR", "latitude" => -6.7725, "longitude" => 107.08306],
            ["id" => 3204, "name" => "KABUPATEN BANDUNG", "latitude" => -7.1, "longitude" => 107.6],
            ["id" => 3205, "name" => "KABUPATEN GARUT", "latitude" => -7.38333, "longitude" => 107.76667],
            ["id" => 3206, "name" => "KABUPATEN TASIKMALAYA", "latitude" => -7.5, "longitude" => 108.13333],
            ["id" => 3207, "name" => "KABUPATEN CIAMIS", "latitude" => -7.28333, "longitude" => 108.41667],
            ["id" => 3208, "name" => "KABUPATEN KUNINGAN", "latitude" => -7, "longitude" => 108.55],
            ["id" => 3209, "name" => "KABUPATEN CIREBON", "latitude" => -6.8, "longitude" => 108.56667],
            ["id" => 3210, "name" => "KABUPATEN MAJALENGKA", "latitude" => -6.81667, "longitude" => 108.28333],
            ["id" => 3211, "name" => "KABUPATEN SUMEDANG", "latitude" => -6.81667, "longitude" => 107.98333],
            ["id" => 3212, "name" => "KABUPATEN INDRAMAYU", "latitude" => -6.45, "longitude" => 108.16667],
            ["id" => 3213, "name" => "KABUPATEN SUBANG", "latitude" => -6.50833, "longitude" => 107.7025],
            ["id" => 3214, "name" => "KABUPATEN PURWAKARTA", "latitude" => -6.58333, "longitude" => 107.45],
            ["id" => 3215, "name" => "KABUPATEN KARAWANG", "latitude" => -6.26667, "longitude" => 107.41667],
            ["id" => 3216, "name" => "KABUPATEN BEKASI", "latitude" => -6.24667, "longitude" => 107.10833],
            ["id" => 3217, "name" => "KABUPATEN BANDUNG BARAT", "latitude" => -6.83333, "longitude" => 107.48333],
            ["id" => 3218, "name" => "KABUPATEN PANGANDARAN", "latitude" => -7.6673, "longitude" => 108.64037],
            ["id" => 3271, "name" => "KOTA BOGOR", "latitude" => -6.59167, "longitude" => 106.8],
            ["id" => 3272, "name" => "KOTA SUKABUMI", "latitude" => -6.95, "longitude" => 106.93333],
            ["id" => 3273, "name" => "KOTA BANDUNG", "latitude" => -6.9175, "longitude" => 107.62444],
            ["id" => 3274, "name" => "KOTA CIREBON", "latitude" => -6.75, "longitude" => 108.55],
            ["id" => 3275, "name" => "KOTA BEKASI", "latitude" => -6.28333, "longitude" => 106.98333],
            ["id" => 3276, "name" => "KOTA DEPOK", "latitude" => -6.4, "longitude" => 106.81667],
            ["id" => 3277, "name" => "KOTA CIMAHI", "latitude" => -6.89167, "longitude" => 107.55],
            ["id" => 3278, "name" => "KOTA TASIKMALAYA", "latitude" => -7.35, "longitude" => 108.21667],
            ["id" => 3279, "name" => "KOTA BANJAR", "latitude" => -7.36996, "longitude" => 108.53209],
        ];

        foreach ($regencies as $regency) {
            DB::table('regencies')->updateOrInsert(
                ['id' => $regency['id']],
                [
                    'name' => $regency['name'],
                    'latitude' => $regency['latitude'],
                    'longitude' => $regency['longitude'],
                ]
            );
        }
    }
}
