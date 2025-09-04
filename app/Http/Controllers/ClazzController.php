<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassRequest;
use App\Http\Requests\UpdateClassRequest;
use App\Http\Resources\ClazzResource;
use App\Models\Clazz;
use Illuminate\Http\Request;

class ClazzController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();
        $perPage = (int) $request->get('per_page', 15);

        $list = Clazz::with('teacher:id,name,email,phone')
            ->when($q, fn($qr) => $qr->where(function ($w) use ($q) {
                $w->where('name','like',"%$q%")
                    ->orWhere('location','like',"%$q%");
            }))
            ->latest('id')
            ->paginate($perPage)
            ->appends($request->query());

        return ClazzResource::collection($list);
    }

    public function store(StoreClassRequest $request)
    {
        $clazz = Clazz::create($request->validated());
        return (new ClazzResource($clazz->load('teacher')))->response()->setStatusCode(201);
    }

    public function show(Clazz $class) // Route Model Binding: param {class}
    {
        return new ClazzResource($class->load('teacher'));
    }

    public function update(UpdateClassRequest $request, Clazz $class)
    {
        $class->update($request->validated());
        return new ClazzResource($class->load('teacher'));
    }

    public function destroy(Clazz $class)
    {
        $class->delete();
//        return response()->noContent();
        return response()->json([
            'message' => 'Class deleted successfully',
            'id' => $class->id,
        ], 200);
    }
}
