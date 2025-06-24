<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleApiController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $pageSize = $request->query('pageSize', 10);
        $roles = Role::orderBy('id', 'asc')
            ->paginate((int) $pageSize, ['*'], 'page', (int) $page);
            
        $array = $this->camelKeys($roles->toArray());
        $customPagination = [
            'currentPage' => $roles->currentPage(),
            'pageSize' => $roles->perPage(),
            'total' => $roles->total(),
            'data' => $array['data'] ?? [],
        ];
        return $this->response($customPagination, 'Retrieved successfully');
    }

    public function show(int $id)
    {
        $role = Role::with('menus')->findOrFail($id);
        $array = $this->camelKeys($role->toArray());

        return $this->response($array, 'Retrieved successfully');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'unique:roles,name'],
        ]);

        $role = Role::create(['name' => $data['name']]);

        $array = $this->camelKeys($role->toArray());

        return $this->response($array, 'Created', 201);
    }

}
