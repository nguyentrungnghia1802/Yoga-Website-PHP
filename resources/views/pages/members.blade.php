@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Members</h2>
        <div class="row g-4">
            @foreach($customers as $customer)
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $customer->name }}</h5>
                        <p class="card-text">{{ $customer->email }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
