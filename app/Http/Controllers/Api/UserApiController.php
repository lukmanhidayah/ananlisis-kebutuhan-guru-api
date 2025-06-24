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
        $perPage = $request->query('per_page', 15);

        $query = User::with('role');
        if ($email) {
            $query->where('email', 'like', "%$email%");
        }

        $users = $query->paginate((int) $perPage);
        $array = $this->camelKeys($users->toArray());

        return $this->response($array, 'OK');
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        $data = $user->toArray();
        $data['role'] = $user->role->name ?? null;
        $data = $this->camelKeys($data);

        return $this->response($data, 'OK');
    }

    public function show(int $id)
    {
        $user = User::with('role')->findOrFail($id);
        $data = $this->camelKeys($user->toArray());

        return $this->response($data, 'OK');
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