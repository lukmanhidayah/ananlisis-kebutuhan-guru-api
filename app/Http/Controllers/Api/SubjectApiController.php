<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectApiController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $pageSize = $request->query('pageSize', 10);
        $subjects = Subject::orderBy('id', 'asc')
            ->paginate((int) $pageSize, ['*'], 'page', (int) $page);

        $array = $this->camelKeys($subjects->toArray());
        $customPagination = [
            'currentPage' => $subjects->currentPage(),
            'pageSize' => $subjects->perPage(),
            'total' => $subjects->total(),
            'data' => $array['data'] ?? [],
        ];

        return $this->response($customPagination, 'Data berhasil diambil');
    }

    public function show(int $id)
    {
        $subject = Subject::findOrFail($id);
        $array = $this->camelKeys($subject->toArray());

        return $this->response($array, 'Data berhasil diambil');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'unique:subjects,name'],
        ]);

        $subject = Subject::create($data);
        $array = $this->camelKeys($subject->toArray());

        return $this->response($array, 'Data berhasil disimpan', 201);
    }

    public function update(Request $request, int $id)
    {
        $subject = Subject::findOrFail($id);
        $data = $request->validate([
            'name' => ['string', 'unique:subjects,name,' . $id],
        ]);

        $subject->update($data);
        $array = $this->camelKeys($subject->toArray());

        return $this->response($array, 'Data berhasil diperbarui');
    }

    public function destroy(int $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return $this->response(null, 'Data berhasil dihapus');
    }
}
