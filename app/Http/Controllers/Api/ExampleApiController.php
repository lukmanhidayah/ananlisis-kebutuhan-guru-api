<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ExampleApiController extends Controller
{
    public function index()
    {
        $data = ['hello' => 'world'];

        return $this->response($data, 'OK');
    }
}
