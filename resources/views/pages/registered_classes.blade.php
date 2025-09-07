@extends('layouts.app')

@section('title', 'Lớp học đã đăng ký')

@section('content')
<h1 class="page-title">📝 Lớp học đã đăng ký</h1>
<div class="registered-classes-list">
    @forelse($registrations as $registration)
        <div class="class-card">
            <h3>{{ $registration->class->name }}</h3>
            <p>{{ $registration->class->description }}</p>
            <span class="time">⏰ {{ $registration->class->start_time }} - {{ $registration->class->end_time }}</span>
            <span class="teacher">👨‍🏫 Giảng viên: {{ $registration->class->teacher->name ?? 'Chưa có' }}</span>
            <a href="{{ route('registered.class.detail', $registration->class->id) }}" class="btn btn-primary" style="margin-top: 10px;">Xem chi tiết lớp học</a>
        </div>
    @empty
        <div class="alert alert-info">Bạn chưa đăng ký lớp học nào.</div>
    @endforelse
</div>
@endsection
