<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeacherResource;
use App\Http\Resources\YogaClassResource;
use App\Models\Teacher;
use App\Models\YogaClass;
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
    }

    public function teacher($id)
    {
        return new TeacherResource(Teacher::findOrFail($id));
    }

    public function classes(Request $request)
    {
        $q    = $request->string('q')->toString();
        $per  = (int) $request->get('per_page', 20);

        $list = YogaClass::with('teacher:id,name')
            ->when($q, fn($qr) => $qr->where('name', 'like', "%$q%"))
            ->latest('id')
            ->paginate($per)
            ->appends($request->query());

        return YogaClassResource::collection($list);
    }

    public function class($id)
    {
        return new YogaClassResource(YogaClass::with('teacher:id,name')->findOrFail($id));
    }
}
