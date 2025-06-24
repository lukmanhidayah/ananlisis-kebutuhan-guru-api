<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserApiController extends Controller
{
    public function index(Request $request)
    {
        $email = $request->query('email');
        $page = $request->query('page', 1);
        $perPage = $request->query('pageSize', 10);

        $query = User::query()
            ->with('role')
            ->select('id', 'name', 'email', 'status', 'created_at', 'updated_at', 'role_id');

        if ($email) {
            $query->where('email', 'like', "%$email%");
        }

        $users = $query->orderBy('id', 'asc')
            ->paginate((int) $perPage, ['*'], 'page', (int) $page);

        $array = $this->camelKeys($users->toArray());
        $customPagination = [
            'currentPage' => $users->currentPage(),
            'pageSize' => $users->perPage(),
            'total' => $users->total(),
            'data' => $array['data'] ?? [],
        ];

        return $this->response($customPagination, 'Retrieved successfully');
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        $data = $user->toArray();
        $data['role'] = $user->role->name ?? null;
        $data = $this->camelKeys($data);

        return $this->response($data, 'Retrieved successfully');
    }

    public function show(int $id)
    {
        $user = User::with('role')->findOrFail($id);
        $data = $this->camelKeys($user->toArray());

        return $this->response($data, 'Retrieved successfully');
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
