<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearApiController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $pageSize = $request->query('pageSize', 10);
        $years = AcademicYear::orderBy('id', 'asc')
            ->paginate((int) $pageSize, ['*'], 'page', (int) $page);

        $array = $this->camelKeys($years->toArray());
        $customPagination = [
            'currentPage' => $years->currentPage(),
            'pageSize' => $years->perPage(),
            'total' => $years->total(),
            'result' => $array['data'] ?? [],
        ];

        return $this->response($customPagination, 'Data berhasil diambil');
    }

    public function show(int $id)
    {
        $year = AcademicYear::findOrFail($id);
        $array = $this->camelKeys($year->toArray());

        return $this->response($array, 'Data berhasil diambil');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'unique:academic_years,code'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        $year = AcademicYear::create($data);
        $array = $this->camelKeys($year->toArray());

        return $this->response($array, 'Data berhasil disimpan', 201);
    }

    public function update(Request $request, int $id)
    {
        $year = AcademicYear::findOrFail($id);
        $data = $request->validate([
            'code' => ['string', 'unique:academic_years,code,' . $id],
            'start_date' => ['date'],
            'end_date' => ['date'],
        ]);

        $year->update($data);
        $array = $this->camelKeys($year->toArray());

        return $this->response($array, 'Data berhasil diperbarui');
    }

    public function destroy(int $id)
    {
        $year = AcademicYear::findOrFail($id);
        $year->delete();

        return $this->response(null, 'Data berhasil dihapus');
    }
}
