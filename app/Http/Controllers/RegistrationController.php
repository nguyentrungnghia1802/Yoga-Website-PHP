<?php

namespace App\Http\Controllers;

use App\Enums\RegistrationStatus;
use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Requests\UpdateRegistrationRequest;
use App\Http\Resources\RegistrationResource;
use App\Models\Clazz;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 15);
        $status  = $request->string('status')->toString();
        $classId = $request->get('class_id');
        $custId  = $request->get('customer_id');

        $list = Registration::with(['customer:id,name,phone,email','class:id,name,teacher_id,quantity,price'])
            ->when($status, fn($q) => $q->where('status', $status))
            ->when($classId, fn($q) => $q->where('class_id', $classId))
            ->when($custId, fn($q) => $q->where('customer_id', $custId))
            ->latest('id')
            ->paginate($perPage)
            ->appends($request->query());

        return RegistrationResource::collection($list);
    }

    public function store(StoreRegistrationRequest $request)
    {
        $data = $request->validated();

        return DB::transaction(function () use ($data) {
            $class = Clazz::lockForUpdate()->findOrFail($data['class_id']);
            $discountPercent = $this->discountForMonths((int)$data['package_months']);
            $final = $class->price * $data['package_months'] * (1 - $discountPercent/100);

            $reg = Registration::create([
                ...$data,
                'discount'    => $discountPercent,
                'final_price' => $final,
                'status'      => RegistrationStatus::PENDING->value,
            ]);

            return (new RegistrationResource($reg->load(['customer','class'])))->response()->setStatusCode(201);
        });
    }

    public function show(Registration $registration)
    {
        return new RegistrationResource($registration->load(['customer','class']));
    }

    public function update(UpdateRegistrationRequest $request, Registration $registration)
    {
        $data = $request->validated();

        if (isset($data['package_months'])) {
            $class = Clazz::findOrFail($registration->class_id);
            $discountPercent = $this->discountForMonths((int)$data['package_months']);
            $data['discount']    = $discountPercent;
            $data['final_price'] = $class->price * $data['package_months'] * (1 - $discountPercent/100);
        }

        if (isset($data['class_id'])) {
            $class = Clazz::findOrFail($data['class_id']);
            $months = (int)($data['package_months'] ?? $registration->package_months);
            $discountPercent = $this->discountForMonths($months);
            $data['discount']    = $discountPercent;
            $data['final_price'] = $class->price * $months * (1 - $discountPercent/100);
        }

        $registration->update($data);
        return new RegistrationResource($registration->load(['customer','class']));
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();
//        return response()->noContent();
        return response()->json([
            'message' => 'Registration deleted successfully',
            'id' => $registration->id,
        ], 200);
    }

    public function confirm($id)
    {
        return DB::transaction(function () use ($id) {
            $reg = Registration::lockForUpdate()->findOrFail($id);

            if ($reg->status == RegistrationStatus::CONFIRMED) {
                return response()->json([
                    'message' => 'This registration is already confirmed.'
                ], 400);
            }

            $class = Clazz::lockForUpdate()->findOrFail($reg->class_id);

            $confirmed = Registration::where('class_id', $class->id)
                ->where('status', RegistrationStatus::CONFIRMED->value)
                ->count();

            if ($confirmed >= $class->quantity) {
                return response()->json(['message' => 'Class is full'], 422);
            }

//            $reg->status = RegistrationStatus::CONFIRMED->value;
//            $reg->save();
            $reg->update(['status' => RegistrationStatus::CONFIRMED]);

//            return new RegistrationResource($reg->load(['customer','class']));
            return response()->json([
                'message' => 'Registration confirmed successfully.',
                'data'    => new RegistrationResource($reg->load(['customer','class']))
            ], 200);
        });
    }

    public function cancel($id)
    {
//        $reg = Registration::findOrFail($id);
//        $reg->status = RegistrationStatus::CANCELLED->value;
//        $reg->save();
        $reg = Registration::lockForUpdate()->findOrFail($id);

        if ($reg->status == RegistrationStatus::CANCELLED) {
            return response()->json([
                'message' => 'This registration is already cancelled.'
            ], 400);
        }


        $reg->update(['status' => RegistrationStatus::CANCELLED]);

//        return new RegistrationResource($reg->load(['customer','class']));
        return response()->json([
            'message' => 'Registration cancelled successfully.',
            'data'    => new RegistrationResource($reg->load(['customer','class']))
        ], 200);
    }

    private function discountForMonths(int $months): int
    {
        return match($months) {
            1 => 0,
            3 => 5,
            6 => 10,
            12 => 20,
            default => 0,
        };
    }
}
