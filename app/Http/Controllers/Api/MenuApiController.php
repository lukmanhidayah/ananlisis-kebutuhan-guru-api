<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuApiController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $menus = Menu::where('role_id', $user->role_id)->get();
        $array = $this->camelKeys($menus->toArray());

        return $this->response($array, 'OK');
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
