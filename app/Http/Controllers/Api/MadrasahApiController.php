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
        $levelId = $request->query('madrasahLevelId');
        $regencyId = $request->query('regencyId');
        $subjectShortageId = $request->query('subjectShortageId');
        $subjectExcessId = $request->query('subjectExcessId');

        $query = Madrasah::query()->orderBy('id', 'asc');

        if ($levelId) {
            $query->where('madrasah_level_id', $levelId);
        }

        if ($regencyId) {
            $query->where('regency_id', $regencyId);
        }

        if ($subjectShortageId) {
            $query->whereHas('teacherNeeds', function ($q) use ($subjectShortageId) {
                $q->where('subject_id', $subjectShortageId)
                    ->whereHas('calculations', function ($qc) {
                        $qc->where('result', '>', 0);
                    });
            });
        }

        if ($subjectExcessId) {
            $query->whereHas('teacherNeeds', function ($q) use ($subjectExcessId) {
                $q->where('subject_id', $subjectExcessId)
                    ->whereHas('calculations', function ($qc) {
                        $qc->where('result', '<', 0);
                    });
            });
        }

        $madrasahs = $query->paginate((int) $pageSize, ['*'], 'page', (int) $page);

        $array = $this->camelKeys($madrasahs->toArray());
        $customPagination = [
            'currentPage' => $madrasahs->currentPage(),
            'pageSize' => $madrasahs->perPage(),
            'total' => $madrasahs->total(),
            'result' => $array['data'] ?? [],
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
