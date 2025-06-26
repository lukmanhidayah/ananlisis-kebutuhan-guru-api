<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Regency;
use Illuminate\Http\Request;

class RegencyApiController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $pageSize = $request->query('pageSize', 10);

        $regencies = Regency::orderBy('id', 'asc')
            ->paginate((int) $pageSize, ['*'], 'page', (int) $page);

        $array = $this->camelKeys($regencies->toArray());
        $customPagination = [
            'currentPage' => $regencies->currentPage(),
            'pageSize' => $regencies->perPage(),
            'total' => $regencies->total(),
            'result' => $array['data'] ?? [],
        ];

        return $this->response($customPagination, 'Data berhasil diambil');
    }
}
