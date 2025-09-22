@extends('layouts.admin')

@section('title', 'Chi tiết Giảng viên - Admin')

@section('content')
<div class="page-header">
    <div class="header-navigation">
        <a href="{{ route('admin.teachers') }}" class="back-btn">
            ← Quay lại danh sách
        </a>
        <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="edit-btn">
            ✏️ Chỉnh sửa
        </a>
    </div>
    <div class="header-content">
        <h1>👨‍🏫 Chi tiết Giảng viên: {{ $teacher->name }}</h1>
    </div>
</div>

<div class="detail-container">
    <div class="detail-grid">
        <!-- Teacher Information -->
        <div class="detail-section">
            <div class="section-header">
                <h2>📋 Thông tin cá nhân</h2>
            </div>
            <div class="section-content">
                <div class="teacher-avatar-large">
                    {{ substr($teacher->name, 0, 1) }}
                </div>
                
                <div class="info-rows">
                    <div class="info-row">
                        <span class="info-label">👤 Tên đầy đủ:</span>
                        <span class="info-value">{{ $teacher->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">📧 Email:</span>
                        <span class="info-value">{{ $teacher->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">📱 Số điện thoại:</span>
                        <span class="info-value">{{ $teacher->phone }}</span>
                    </div>
                    @if($teacher->birthday)
                    <div class="info-row">
                        <span class="info-label">🎂 Ngày sinh:</span>
                        <span class="info-value">{{ $teacher->birthday->format('d/m/Y') }}</span>
                    </div>
                    @endif
                    <div class="info-row">
                        <span class="info-label">📈 Kinh nghiệm:</span>
                        <span class="info-value">{{ $teacher->exp_year }} năm</span>
                    </div>
                    @if($teacher->level)
                    <div class="info-row">
                        <span class="info-label">🏆 Trình độ:</span>
                        <span class="info-value level-badge level-{{ strtolower($teacher->level) }}">{{ $teacher->level }}</span>
                    </div>
                    @endif
                    @if($teacher->description)
                    <div class="info-row">
                        <span class="info-label">📝 Mô tả:</span>
                        <div class="info-value description-text">{{ $teacher->description }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Classes Teaching -->
        <div class="detail-section">
            <div class="section-header">
                <h2>🧘‍♀️ Lớp học đang dạy ({{ $teacher->classes->count() }})</h2>
            </div>
            <div class="section-content">
                @forelse($teacher->classes as $class)
                    <div class="class-item">
                        <div class="class-info">
                            <div class="class-name">{{ $class->name }}</div>
                            <div class="class-details">
                                <span class="class-time">⏰ {{ $class->start_time->format('H:i') }} - {{ $class->end_time->format('H:i') }}</span>
                                <span class="class-schedule">📅 {{ $class->lich_hoc ?? 'Chưa xác định' }}</span>
                                <span class="class-location">📍 {{ $class->location }}</span>
                            </div>
                            <div class="class-meta">
                                <span class="class-capacity">👥 {{ $class->registrations()->where('status', 'CONFIRMED')->count() }}/{{ $class->quantity }} học viên</span>
                                <span class="class-price">💰 {{ number_format($class->price) }} VNĐ</span>
                            </div>
                        </div>
                        <div class="class-actions">
                            <a href="{{ route('admin.classes.detail', $class->id) }}" class="action-btn view-btn">
                                👁️ Xem chi tiết
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <p>🏫 Giảng viên chưa được phân công dạy lớp nào</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="stats-section">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">🏫</div>
                <div class="stat-number">{{ $teacher->classes->count() }}</div>
                <div class="stat-label">Lớp học</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-number">{{ $teacher->classes->sum(function($class) { return $class->registrations()->where('status', 'CONFIRMED')->count(); }) }}</div>
                <div class="stat-label">Tổng học viên</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📈</div>
                <div class="stat-number">{{ $teacher->exp_year }}</div>
                <div class="stat-label">Năm kinh nghiệm</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-number">{{ number_format($teacher->classes->sum('price')) }}</div>
                <div class="stat-label">Tổng giá trị (VNĐ)</div>
            </div>
        </div>
    </div>

    <div class="action-buttons">
        <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="action-btn edit-btn">
            ✏️ Chỉnh sửa giảng viên
        </a>
        <a href="{{ route('admin.teachers') }}" class="action-btn secondary-btn">
            📋 Quay lại danh sách
        </a>
    </div>
</div>

@push('styles')
<style>
.page-header {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.header-navigation {
    margin-bottom: 15px;
    display: flex;
    gap: 10px;
}

.back-btn, .edit-btn {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    padding: 8px 16px;
    border-radius: 6px;
    background: #f8f9fa;
    transition: all 0.2s;
}

.back-btn:hover, .edit-btn:hover {
    background: #e9ecef;
}

.header-content h1 {
    font-size: 2rem;
    color: #333;
    margin: 0;
}

.detail-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 30px;
}

.detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
}

.detail-section {
    padding: 30px;
    border-right: 1px solid #f8f9fa;
}

.detail-section:last-child {
    border-right: none;
}

.section-header {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f8f9fa;
}

.section-header h2 {
    color: #333;
    font-size: 1.3rem;
    margin: 0;
}

.teacher-avatar-large {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #fd7e14;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: bold;
    margin: 0 auto 25px;
}

.info-rows {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.info-row {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.info-label {
    min-width: 140px;
    font-weight: 600;
    color: #666;
    flex-shrink: 0;
}

.info-value {
    color: #333;
    flex: 1;
}

.description-text {
    background: #f8f9fa;
    padding: 10px;
    border-radius: 6px;
    font-style: italic;
    color: #666;
}

.level-badge {
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.85rem;
    font-weight: 500;
}

.level-beginner {
    background: #d4edda;
    color: #155724;
}

.level-intermediate {
    background: #fff3cd;
    color: #856404;
}

.level-advanced {
    background: #f8d7da;
    color: #721c24;
}

.level-expert {
    background: #d1ecf1;
    color: #0c5460;
}

.class-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f8f9fa;
}

.class-item:last-child {
    border-bottom: none;
}

.class-name {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.class-details {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 5px;
}

.class-details span {
    color: #666;
    font-size: 0.85rem;
}

.class-meta {
    display: flex;
    gap: 15px;
}

.class-meta span {
    color: #666;
    font-size: 0.85rem;
}

.stats-section {
    background: #f8f9fa;
    padding: 30px;
    border-top: 1px solid #dee2e6;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.stat-card {
    background: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.stat-icon {
    font-size: 2rem;
    margin-bottom: 10px;
}

.stat-number {
    font-size: 1.8rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

.stat-label {
    color: #666;
    font-size: 0.9rem;
}

.action-buttons {
    padding: 25px 30px;
    background: #f8f9fa;
    border-top: 1px solid #dee2e6;
    display: flex;
    gap: 15px;
}

.action-btn {
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.view-btn {
    background: #17a2b8;
    color: white;
    padding: 8px 16px;
    font-size: 0.9rem;
}

.view-btn:hover {
    background: #138496;
    color: white;
}

.edit-btn {
    background: #ffc107;
    color: #212529;
}

.edit-btn:hover {
    background: #e0a800;
    color: #212529;
}

.secondary-btn {
    background: #6c757d;
    color: white;
}

.secondary-btn:hover {
    background: #5a6268;
    color: white;
}

.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: #999;
}

@media (max-width: 768px) {
    .detail-grid {
        grid-template-columns: 1fr;
    }
    
    .detail-section {
        border-right: none;
        border-bottom: 1px solid #f8f9fa;
    }
    
    .detail-section:last-child {
        border-bottom: none;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .class-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
}

@media (max-width: 480px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush
@endsection