<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

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

}
