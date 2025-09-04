<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();
        $perPage = (int) $request->get('per_page', 15);

        $list = Customer::query()
            ->when($q, fn($qr) => $qr->where(function ($w) use ($q) {
                $w->where('name','like',"%$q%")
                    ->orWhere('email','like',"%$q%")
                    ->orWhere('phone','like',"%$q%");
            }))
            ->latest('id')
            ->paginate($perPage)
            ->appends($request->query());

        return CustomerResource::collection($list);
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->validated());
        return (new CustomerResource($customer))->response()->setStatusCode(201);
    }

    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        return new CustomerResource($customer);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
//        return response()->noContent();
        return response()->json([
            'message' => 'Customer deleted successfully',
            'id' => $customer->id,
        ], 200);
    }
}
