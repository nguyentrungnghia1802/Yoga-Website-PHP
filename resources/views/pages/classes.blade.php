@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Classes</h2>
        <div class="row g-4">
            @foreach($classes as $class)
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $class->name }}</h5>
                        <p class="card-text">{{ $class->description }}</p>
                        <a href="{{ route('classes.show', $class->id) }}" class="btn btn-outline-primary">Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
