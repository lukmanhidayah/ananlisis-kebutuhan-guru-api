<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Madrasah;
use Illuminate\Http\Request;

class MadrasahApiController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $pageSize = $request->query('pageSize', 10);
        $madrasahs = Madrasah::orderBy('id', 'asc')
            ->paginate((int) $pageSize, ['*'], 'page', (int) $page);

        $array = $this->camelKeys($madrasahs->toArray());
        $customPagination = [
            'currentPage' => $madrasahs->currentPage(),
            'pageSize' => $madrasahs->perPage(),
            'total' => $madrasahs->total(),
            'data' => $array['data'] ?? [],
        ];

        return $this->response($customPagination, 'Retrieved successfully');
    }

    public function show(int $id)
    {
        $madrasah = Madrasah::findOrFail($id);
        $array = $this->camelKeys($madrasah->toArray());

        return $this->response($array, 'Retrieved successfully');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nsm' => ['required', 'string', 'unique:madrasahs,nsm'],
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'madrasah_level_id' => ['required', 'integer', 'exists:madrasah_levels,id'],
            'regency_id' => ['required', 'integer'],
            'district_id' => ['required', 'integer'],
            'village_id' => ['required', 'integer'],
            'kepala_madrasah' => ['string'],
            'wakakur_name' => ['string'],
            'wakakur_phone' => ['string'],
        ]);

        $madrasah = Madrasah::create($data);

        $array = $this->camelKeys($madrasah->toArray());

        return $this->response($array, 'Data berhasil disimpan', 201);
    }

    public function update(Request $request, int $id)
    {
        $madrasah = Madrasah::findOrFail($id);
        $data = $request->validate([
            'nsm' => ['string', 'unique:madrasahs,nsm,' . $id],
            'name' => ['string'],
            'address' => ['string'],
            'madrasah_level_id' => ['integer', 'exists:madrasah_levels,id'],
            'regency_id' => ['integer'],
            'district_id' => ['integer'],
            'village_id' => ['integer'],
            'kepala_madrasah' => ['string'],
            'wakakur_name' => ['string'],
            'wakakur_phone' => ['string'],
        ]);

        $madrasah->update($data);

        $array = $this->camelKeys($madrasah->toArray());

        return $this->response($array, 'Data berhasil diperbarui');
    }

    public function destroy(int $id)
    {
        $madrasah = Madrasah::findOrFail($id);
        $madrasah->delete();

        return $this->response(null, 'Data berhasil dihapus');
    }

}
