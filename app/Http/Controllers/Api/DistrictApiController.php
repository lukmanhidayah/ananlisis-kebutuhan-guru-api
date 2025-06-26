<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictApiController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $pageSize = $request->query('pageSize', 10);
        $regencyId = $request->query('regencyId');

        $query = District::query()->orderBy('id', 'asc');

        if ($regencyId) {
            $query->where('regency_id', $regencyId);
        }

        $districts = $query->paginate((int) $pageSize, ['*'], 'page', (int) $page);

        $array = $this->camelKeys($districts->toArray());
        $customPagination = [
            'currentPage' => $districts->currentPage(),
            'pageSize' => $districts->perPage(),
            'total' => $districts->total(),
            'result' => $array['data'] ?? [],
        ];

        return $this->response($customPagination, 'Data berhasil diambil');
    }
}
