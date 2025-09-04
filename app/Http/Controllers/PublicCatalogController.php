<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeacherResource;
use App\Http\Resources\ClazzResource;
use App\Models\Teacher;
use App\Models\Clazz;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class PublicCatalogController extends Controller
{
    public function teachers(Request $request)
    {
        $q    = $request->string('q')->toString();
        $per  = (int) $request->get('per_page', 20);

        $list = Teacher::query()
            ->when($q, fn($qr) => $qr->where('name', 'like', "%$q%"))
            ->latest('id')
            ->paginate($per)
            ->appends($request->query());

        return TeacherResource::collection($list);
        $q = $request->query('q');
        $q = is_string($q) ? trim($q) : null;
        if ($q === '' || strcasecmp($q, 'null') === 0 || strcasecmp($q, 'undefined') === 0) {
            $q = null;
        }
    }

    public function teacher($id)
    {
        return new TeacherResource(Teacher::findOrFail($id));
    }

    public function classes(Request $request)
    {
        $q    = $request->string('q')->toString();
        $per  = (int) $request->get('per_page', 20);

        $list = Clazz::with('teacher:id,name')
            ->when($q, fn($qr) => $qr->where('name', 'like', "%$q%"))
            ->latest('id')
            ->paginate($per)
            ->appends($request->query());

        return ClazzResource::collection($list);
    }

    public function class($id)
    {
        return new ClazzResource(Clazz::with('teacher:id,name')->findOrFail($id));
    }
}
