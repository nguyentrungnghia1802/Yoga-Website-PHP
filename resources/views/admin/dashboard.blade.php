@extends('layouts.admin')

@section('title', 'Dashboard - Admin')

@section('content')
<div class="dashboard-header">
    <h1>📊 Dashboard Admin</h1>
    <p>Tổng quan hệ thống quản lý Yoga/Gym Center</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">🧘‍♀️</div>
        <div class="stat-content">
            <h3>{{ $stats['classes'] }}</h3>
            <p>Lớp học</p>
        </div>
        <a href="{{ route('admin.classes') }}" class="stat-link">Quản lý →</a>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">👥</div>
        <div class="stat-content">
            <h3>{{ $stats['customers'] }}</h3>
            <p>Học viên</p>
        </div>
        <a href="{{ route('admin.customers') }}" class="stat-link">Quản lý →</a>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">👨‍🏫</div>
        <div class="stat-content">
            <h3>{{ $stats['teachers'] }}</h3>
            <p>Giảng viên</p>
        </div>
        <a href="{{ route('admin.teachers') }}" class="stat-link">Quản lý →</a>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">📝</div>
        <div class="stat-content">
            <h3>{{ $stats['registrations'] }}</h3>
            <p>Tổng đăng ký</p>
        </div>
        <a href="{{ route('admin.registrations') }}" class="stat-link">Xem tất cả →</a>
    </div>
</div>

<div class="dashboard-content">
    <div class="dashboard-section">
        <div class="section-header">
            <h2>📋 Trạng thái đăng ký</h2>
        </div>
        <div class="registration-status">
            <div class="status-item pending">
                <div class="status-number">{{ $stats['pending_registrations'] }}</div>
                <div class="status-label">Chờ duyệt</div>
            </div>
            <div class="status-item approved">
                <div class="status-number">{{ $stats['approved_registrations'] }}</div>
                <div class="status-label">Đã duyệt</div>
            </div>
            <div class="status-item rejected">
                <div class="status-number">{{ $stats['registrations'] - $stats['approved_registrations'] - $stats['pending_registrations'] }}</div>
                <div class="status-label">Từ chối</div>
            </div>
        </div>
    </div>

    <div class="dashboard-section">
        <div class="section-header">
            <h2>🕒 Đăng ký gần đây</h2>
            <a href="{{ route('admin.registrations') }}" class="section-link">Xem tất cả →</a>
        </div>
        <div class="recent-registrations">
            @forelse($recentRegistrations as $registration)
                <div class="registration-item">
                    <div class="registration-info">
                        <div class="customer-name">
                            👤 {{ $registration->customer->name }}
                        </div>
                        <div class="class-name">
                            🧘‍♀️ {{ $registration->class->name }}
                        </div>
                        <div class="registration-time">
                            🕒 {{ $registration->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div class="registration-status-badge status-{{ strtolower($registration->status) }}">
                        @switch($registration->status)
                            @case('PENDING')
                                ⏳ Chờ duyệt
                                @break
                            @case('APPROVED')
                                ✅ Đã duyệt
                                @break
                            @case('REJECTED')
                                ❌ Từ chối
                                @break
                            @default
                                📝 {{ $registration->status }}
                        @endswitch
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <p>📭 Chưa có đăng ký nào</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@push('styles')
<style>
.dashboard-header {
    margin-bottom: 30px;
    text-align: center;
}

.dashboard-header h1 {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 10px;
}

.dashboard-header p {
    color: #666;
    font-size: 1.1rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.stat-card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 20px;
    transition: transform 0.2s;
}

.stat-card:hover {
    transform: translateY(-2px);
}

.stat-icon {
    font-size: 3rem;
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
}

.stat-content h3 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 5px;
}

.stat-content p {
    color: #666;
    font-size: 1rem;
}

.stat-link {
    margin-left: auto;
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
}

.dashboard-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
}

.dashboard-section {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f8f9fa;
}

.section-header h2 {
    color: #333;
    font-size: 1.3rem;
}

.section-link {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
}

.registration-status {
    display: flex;
    gap: 20px;
    justify-content: space-around;
}

.status-item {
    text-align: center;
    padding: 20px;
    border-radius: 10px;
    flex: 1;
}

.status-item.pending {
    background: #fff3cd;
    color: #856404;
}

.status-item.approved {
    background: #d4edda;
    color: #155724;
}

.status-item.rejected {
    background: #f8d7da;
    color: #721c24;
}

.status-number {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 5px;
}

.status-label {
    font-size: 0.9rem;
}

.registration-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f8f9fa;
}

.registration-item:last-child {
    border-bottom: none;
}

.customer-name {
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.class-name {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 3px;
}

.registration-time {
    color: #999;
    font-size: 0.8rem;
}

.registration-status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    white-space: nowrap;
}

.status-pending {
    background: #fff3cd;
    color: #856404;
}

.status-approved {
    background: #d4edda;
    color: #155724;
}

.status-rejected {
    background: #f8d7da;
    color: #721c24;
}

.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: #999;
}

@media (max-width: 768px) {
    .dashboard-content {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .stat-card {
        flex-direction: column;
        text-align: center;
    }
    
    .registration-status {
        flex-direction: column;
        gap: 10px;
    }
}
</style>
@endpush
@endsection
