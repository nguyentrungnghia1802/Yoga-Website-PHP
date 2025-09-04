@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Admin Dashboard</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Classes</h5>
                        <p class="card-text">{{ $classesCount ?? 0 }}</p>
                        <a href="{{ route('admin.class') }}" class="btn btn-outline-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Teachers</h5>
                        <p class="card-text">{{ $teachersCount ?? 0 }}</p>
                        <a href="{{ route('admin.teacher') }}" class="btn btn-outline-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Registrations</h5>
                        <p class="card-text">{{ $registrationsCount ?? 0 }}</p>
                        <a href="{{ route('admin.register') }}" class="btn btn-outline-primary">Manage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
