<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassLevel;
use Illuminate\Http\Request;

class ClassLevelApiController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $pageSize = $request->query('pageSize', 10);
        $madrasahLevelId = $request->query('madrasahLevelId');

        $query = ClassLevel::query()->orderBy('id');
        if ($madrasahLevelId) {
            $query->where('madrasah_level_id', $madrasahLevelId);
        }
        $levels = $query->paginate((int) $pageSize, ['*'], 'page', (int) $page);

        $array = $this->camelKeys($levels->toArray());
        $customPagination = [
            'currentPage' => $levels->currentPage(),
            'pageSize' => $levels->perPage(),
            'total' => $levels->total(),
            'data' => $array['data'] ?? [],
        ];

        return $this->response($customPagination, 'Data berhasil diambil');
    }

    public function show(int $id)
    {
        $level = ClassLevel::findOrFail($id);
        $array = $this->camelKeys($level->toArray());

        return $this->response($array, 'Data berhasil diambil');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'unique:class_levels,name'],
            'description' => ['string'],
            'madrasah_level_id' => ['required', 'integer', 'exists:madrasah_levels,id'],
        ]);

        $level = ClassLevel::create($data);
        $array = $this->camelKeys($level->toArray());

        return $this->response($array, 'Data berhasil disimpan', 201);
    }

    public function update(Request $request, int $id)
    {
        $level = ClassLevel::findOrFail($id);
        $data = $request->validate([
            'name' => ['string', 'unique:class_levels,name,' . $id],
            'description' => ['string'],
            'madrasah_level_id' => ['integer', 'exists:madrasah_levels,id'],
        ]);

        $level->update($data);
        $array = $this->camelKeys($level->toArray());

        return $this->response($array, 'Data berhasil diperbarui');
    }

    public function destroy(int $id)
    {
        $level = ClassLevel::findOrFail($id);
        $level->delete();

        return $this->response(null, 'Data berhasil dihapus');
    }
}
