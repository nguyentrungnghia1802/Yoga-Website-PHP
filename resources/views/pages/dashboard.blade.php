@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Dashboard</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Classes</h5>
                        <p class="card-text">{{ $classesCount ?? 0 }}</p>
                        <a href="{{ route('classes') }}" class="btn btn-outline-primary">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Teachers</h5>
                        <p class="card-text">{{ $teachersCount ?? 0 }}</p>
                        <a href="{{ route('team') }}" class="btn btn-outline-primary">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Members</h5>
                        <p class="card-text">{{ $membersCount ?? 0 }}</p>
                        <a href="{{ route('members') }}" class="btn btn-outline-primary">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Registrations</h5>
                        <p class="card-text">{{ $registrationsCount ?? 0 }}</p>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
