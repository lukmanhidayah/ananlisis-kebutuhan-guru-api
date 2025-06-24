<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class InsightApiController extends Controller
{
    public function index()
    {
        $data = [
            ['title' => 'Total Kebutuhan', 'value' => '0'],
            ['title' => 'Jumlah Kebutuhan', 'value' => '0'],
            ['title' => 'Jumlah Kelebihan', 'value' => '0'],
            ['title' => 'Jumlah Kekurangan', 'value' => '0'],
        ];

        return $this->response($this->camelKeys($data), 'Success');
    }

    private function camelKeys(array $data): array
    {
        $result = [];
        foreach ($data as $key => $value) {
            $key = Str::camel($key);
            if (is_array($value)) {
                $value = $this->camelKeys($value);
            }
            $result[$key] = $value;
        }
        return $result;
    }
}
