@extends('layouts.app')

@section('title', 'Chi tiết lớp học đã đăng ký')

@section('content')
<h1 class="page-title">🧘‍♀️ {{ $class->name }}</h1>
<div class="class-detail">
    <div class="teacher-info">
        <h3>👨‍🏫 Giảng viên</h3>
        <div class="card">
            <div class="card-body">
                <h5>{{ $class->teacher->name }}</h5>
                <p>{{ $class->teacher->description }}</p>
                <p>Email: {{ $class->teacher->email }}</p>
                <p>Phone: {{ $class->teacher->phone }}</p>
            </div>
        </div>
    </div>
    <div class="members-list" style="margin-top: 30px;">
        <h3>👥 Thành viên lớp học</h3>
        <div class="row g-4">
            @foreach($members as $member)
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $member->name }}</h5>
                        <p class="card-text">{{ $member->email }}</p>
                        <p>{{ $member->phone }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
