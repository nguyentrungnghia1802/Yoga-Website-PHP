<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassRequest;
use App\Http\Requests\UpdateClassRequest;
use App\Http\Resources\YogaClassResource;
use App\Models\YogaClass;
use Illuminate\Http\Request;

class YogaClassController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();
        $perPage = (int) $request->get('per_page', 15);

        $list = YogaClass::with('teacher:id,name,email,phone')
            ->when($q, fn($qr) => $qr->where(function ($w) use ($q) {
                $w->where('name','like',"%$q%")
                    ->orWhere('location','like',"%$q%");
            }))
            ->latest('id')
            ->paginate($perPage)
            ->appends($request->query());

        return YogaClassResource::collection($list);
    }

    public function store(StoreClassRequest $request)
    {
        $class = YogaClass::create($request->validated());
        return (new YogaClassResource($class->load('teacher')))->response()->setStatusCode(201);
    }

    public function show(YogaClass $yogaClass) // Route Model Binding: param {yogaClass}
    {
        return new YogaClassResource($yogaClass->load('teacher'));
    }

    public function update(UpdateClassRequest $request, YogaClass $yogaClass)
    {
        $yogaClass->update($request->validated());
        return new YogaClassResource($yogaClass->load('teacher'));
    }

    public function destroy(YogaClass $yogaClass)
    {
        $yogaClass->delete();
        return response()->json([
            'message' => 'Class deleted successfully',
            'id' => $yogaClass->id,
        ], 200);
    }
}
