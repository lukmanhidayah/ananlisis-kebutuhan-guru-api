<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleApiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 15);
        $roles = Role::paginate((int) $perPage);
        $array = $this->camelKeys($roles->toArray());

        return $this->response($array, 'OK');
    }

    public function show(int $id)
    {
        $role = Role::with('menus')->findOrFail($id);
        $array = $this->camelKeys($role->toArray());

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
