@extends('layouts.app')

@section('title', 'Lớp học đã đăng ký')

@section('content')
<h1 class="page-title">📝 Lớp học đã đăng ký</h1>
<div class="registered-classes-list">
    @forelse($registrations as $registration)
        <div class="class-card">
            <div class="class-header">
                <h3>{{ $registration->class->name }}</h3>
                <span class="status-badge confirmed">✅ Đã xác nhận</span>
            </div>
            <p>{{ $registration->class->description }}</p>
            <div class="class-info">
                <span class="time">⏰ {{ $registration->class->start_time->format('H:i') }} - {{ $registration->class->end_time->format('H:i') }}</span>
                <span class="teacher">👨‍🏫 Giảng viên: {{ $registration->class->teacher->name ?? 'Chưa có' }}</span>
                <span class="price">💰 {{ number_format($registration->class->price) }} VNĐ</span>
                <span class="location">📍 {{ $registration->class->location }}</span>
            </div>
            <div class="class-dates">
                <span class="period">📅 {{ $registration->class->start_date->format('d/m/Y') }} - {{ $registration->class->end_date->format('d/m/Y') }}</span>
                <span class="registered">📝 Đăng ký lúc: {{ $registration->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <a href="{{ route('registered.class.detail', $registration->class->id) }}" class="btn btn-primary" style="margin-top: 15px;">Xem chi tiết lớp học</a>
        </div>
    @empty
        <div class="alert alert-info">Bạn chưa có lớp học nào được xác nhận tham gia.</div>
    @endforelse
</div>
@endsection

@push('styles')
<style>
.registered-classes-list {
    display: grid;
    gap: 20px;
    margin-top: 20px;
}

.class-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.2s;
}

.class-card:hover {
    transform: translateY(-2px);
}

.class-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 10px;
}

.class-header h3 {
    margin: 0;
    color: #333;
    font-size: 1.4rem;
}

.status-badge {
    font-size: 0.75rem;
    padding: 4px 10px;
    border-radius: 12px;
    font-weight: 500;
}

.status-badge.confirmed {
    background: #d4edda;
    color: #155724;
}

.class-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 10px;
    margin: 15px 0;
}

.class-info span {
    display: flex;
    align-items: center;
    color: #666;
    font-size: 0.9rem;
}

.class-dates {
    display: flex;
    justify-content: space-between;
    margin: 15px 0;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 6px;
}

.class-dates span {
    color: #666;
    font-size: 0.85rem;
}

.alert {
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    font-weight: 500;
}

.alert-info {
    background: #d1ecf1;
    color: #0c5460;
    border: 1px solid #bee5eb;
}

@media (max-width: 768px) {
    .class-header {
        flex-direction: column;
        gap: 10px;
    }
    
    .class-info {
        grid-template-columns: 1fr;
    }
    
    .class-dates {
        flex-direction: column;
        gap: 5px;
    }
}
</style>
@endpush
