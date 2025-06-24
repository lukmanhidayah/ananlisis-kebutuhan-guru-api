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
        $perPage = $request->query('per_page', 15);
        $menus = Menu::with('roles')->paginate((int) $perPage);
        $array = $this->camelKeys($menus->toArray());

        return $this->response($array, 'OK');
    }

    public function show(int $id)
    {
        $menu = Menu::with('roles')->findOrFail($id);
        $array = $this->camelKeys($menu->toArray());

        return $this->response($array, 'OK');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'url' => ['required', 'string'],
            'role_ids' => ['array'],
        ]);

        $menu = Menu::create([
            'name' => $data['name'],
            'url' => $data['url'],
        ]);

        if (!empty($data['role_ids'])) {
            $menu->roles()->sync($data['role_ids']);
        }

        $menu->load('roles');
        $array = $this->camelKeys($menu->toArray());

        return $this->response($array, 'Created', 201);
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
