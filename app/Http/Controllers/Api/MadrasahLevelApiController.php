<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MadrasahLevel;
use Illuminate\Http\Request;

class MadrasahLevelApiController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $pageSize = $request->query('pageSize', 10);
        $levels = MadrasahLevel::orderBy('id', 'asc')
            ->paginate((int) $pageSize, ['*'], 'page', (int) $page);

        $array = $this->camelKeys($levels->toArray());
        $customPagination = [
            'currentPage' => $levels->currentPage(),
            'pageSize' => $levels->perPage(),
            'total' => $levels->total(),
            'result' => $array['data'] ?? [],
        ];

        return $this->response($customPagination, 'Data berhasil diambil');
    }

    public function show(int $id)
    {
        $level = MadrasahLevel::findOrFail($id);
        $array = $this->camelKeys($level->toArray());

        return $this->response($array, 'Data berhasil diambil');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'unique:madrasah_levels,name'],
            'description' => ['string'],
        ]);

        $level = MadrasahLevel::create($data);
        $array = $this->camelKeys($level->toArray());

        return $this->response($array, 'Data berhasil disimpan', 201);
    }

    public function update(Request $request, int $id)
    {
        $level = MadrasahLevel::findOrFail($id);
        $data = $request->validate([
            'name' => ['string', 'unique:madrasah_levels,name,' . $id],
            'description' => ['string'],
        ]);

        $level->update($data);
        $array = $this->camelKeys($level->toArray());

        return $this->response($array, 'Data berhasil diperbarui');
    }

    public function destroy(int $id)
    {
        $level = MadrasahLevel::findOrFail($id);
        $level->delete();

        return $this->response(null, 'Data berhasil dihapus');
    }
}
