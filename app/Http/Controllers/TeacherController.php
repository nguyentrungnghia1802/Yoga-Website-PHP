<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();
        $perPage = (int) $request->get('per_page', 15);

        $teachers = Teacher::query()
            ->when($q, fn($qr) => $qr->where(function ($w) use ($q) {
                $w->where('name', 'like', "%$q%")
                    ->orWhere('email', 'like', "%$q%")
                    ->orWhere('phone', 'like', "%$q%");
            }))
            ->latest('id')
            ->paginate($perPage)
            ->appends($request->query());

        return TeacherResource::collection($teachers);
    }

    public function store(StoreTeacherRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $teacher = Teacher::create($data);

        return (new TeacherResource($teacher))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Teacher $teacher)
    {
        return new TeacherResource($teacher);
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            // xóa avatar cũ nếu có
            if ($teacher->avatar && Storage::disk('public')->exists($teacher->avatar)) {
                Storage::disk('public')->delete($teacher->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $teacher->update($data);

        return new TeacherResource($teacher);
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
//        return response()->noContent();
        return response()->json([
            'message' => 'Teacher deleted successfully',
            'id' => $teacher->id,
        ], 200);
    }
}
