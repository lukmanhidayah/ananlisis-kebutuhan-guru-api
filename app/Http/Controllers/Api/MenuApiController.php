<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuApiController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $pageSize = $request->query('pageSize', 10);
        $menus = Menu::with('roles')
            ->orderBy('id', 'asc')
            ->paginate((int) $pageSize, ['*'], 'page', (int) $page);
        // Customize pagination result
        $array = $this->camelKeys($menus->toArray());
        $customPagination = [
            'currentPage' => $menus->currentPage(),
            'pageSize' => $menus->perPage(),
            'total' => $menus->total(),
            'data' => $array['data'] ?? [],
        ];

        return $this->response($customPagination, 'Data berhasil diambil');
    }

    public function show(int $id)
    {
        $menu = Menu::findOrFail($id);
        $array = $this->camelKeys($menu->toArray());

        return $this->response($array, 'Data berhasil diambil');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'url' => ['required', 'string'],
            'icon_type' => ['required', 'string'],
            'role_ids' => ['array'],
        ]);

        $menu = Menu::create([
            'name' => $data['name'],
            'url' => $data['url'],
            'icon_type' => $data['icon_type'],
        ]);

        if (!empty($data['role_ids'])) {
            $menu->roles()->sync($data['role_ids']);
        }

        $menu->load('roles');
        $array = $this->camelKeys($menu->toArray());

        return $this->response($array, 'Data berhasil disimpan', 201);
    }

}
