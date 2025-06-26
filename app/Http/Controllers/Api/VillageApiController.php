<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Village;
use Illuminate\Http\Request;

class VillageApiController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $pageSize = $request->query('pageSize', 10);
        $districtId = $request->query('districtId');

        $query = Village::query()->orderBy('id', 'asc');

        if ($districtId) {
            $query->where('district_id', $districtId);
        }

        $villages = $query->paginate((int) $pageSize, ['*'], 'page', (int) $page);

        $array = $this->camelKeys($villages->toArray());
        $customPagination = [
            'currentPage' => $villages->currentPage(),
            'pageSize' => $villages->perPage(),
            'total' => $villages->total(),
            'result' => $array['data'] ?? [],
        ];

        return $this->response($customPagination, 'Data berhasil diambil');
    }
}
