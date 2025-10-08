@extends('layouts.app')

@section('title', 'Chi tiết Giáo viên - ' . $teacher->name)

@push('styles')
<style>
.teacher-detail-container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
}

.teacher-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 40px;
    border-radius: 15px;
    margin-bottom: 30px;
    text-align: center;
}

.teacher-header-content {
    display: flex;
    align-items: center;
    gap: 30px;
    max-width: 800px;
    margin: 0 auto;
}

.teacher-avatar-large {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 4rem;
    font-weight: bold;
    position: relative;
    overflow: hidden;
    flex-shrink: 0;
}

.teacher-avatar-large img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.teacher-info h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
    font-weight: 700;
}

.teacher-meta {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 15px;
}

.teacher-experience-badge {
    background: rgba(255,255,255,0.2);
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    display: inline-block;
}

.teacher-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 30px;
    margin-bottom: 40px;
}

.teacher-main {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.07);
}

.teacher-sidebar {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.07);
    height: fit-content;
}

.section-title {
    color: #333;
    font-size: 1.3rem;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.teacher-description {
    color: #666;
    line-height: 1.8;
    font-size: 1rem;
    margin-bottom: 30px;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 8px;
}

.info-item strong {
    color: #555;
    min-width: 80px;
}

.classes-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.class-item {
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    border-left: 4px solid #667eea;
    transition: all 0.2s;
}

.class-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.class-name {
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.class-schedule {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 5px;
}

.class-price {
    color: #28a745;
    font-weight: 500;
    font-size: 0.9rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 20px;
}

.stat-card {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}

.stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: #667eea;
    display: block;
}

.stat-label {
    color: #666;
    font-size: 0.9rem;
    margin-top: 5px;
}

.back-btn {
    background: #6c757d;
    color: white;
    padding: 12px 24px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
}

.back-btn:hover {
    background: #5a6268;
    color: white;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .teacher-header-content {
        flex-direction: column;
        text-align: center;
    }
    
    .teacher-avatar-large {
        width: 120px;
        height: 120px;
        font-size: 3rem;
    }
    
    .teacher-content {
        grid-template-columns: 1fr;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@section('content')
<div class="teacher-detail-container">
    <a href="{{ route('teachers') }}" class="back-btn">
        ← Quay lại danh sách
    </a>
    
    <div class="teacher-header">
        <div class="teacher-header-content">
            <div class="teacher-avatar-large">
                @if($teacher->avatar && file_exists(public_path('storage/' . $teacher->avatar)))
                    <img src="{{ asset('storage/' . $teacher->avatar) }}" alt="{{ $teacher->name }}">
                @else
                    {{ substr($teacher->name, 0, 1) }}
                @endif
            </div>
            <div class="teacher-info">
                <h1>{{ $teacher->name }}</h1>
                <div class="teacher-meta">
                    📧 {{ $teacher->email }} | 📱 {{ $teacher->phone }}
                </div>
                <div class="teacher-experience-badge">
                    🎓 {{ $teacher->exp_year }} năm kinh nghiệm
                </div>
            </div>
        </div>
    </div>

    <div class="teacher-content">
        <div class="teacher-main">
            <h2 class="section-title">📝 Giới thiệu</h2>
            <p class="teacher-description">
                {{ $teacher->description ?? 'Giáo viên yoga chuyên nghiệp với nhiều năm kinh nghiệm giảng dạy. Được đào tạo bài bản và có chứng chỉ quốc tế về yoga. Luôn tận tâm và nhiệt huyết trong việc hướng dẫn học viên đạt được mục tiêu tập luyện.' }}
            </p>
            
            <h2 class="section-title">📚 Lớp học đang giảng dạy</h2>
            @if($teacher->classes->count() > 0)
                <div class="classes-list">
                    @foreach($teacher->classes as $class)
                    <div class="class-item">
                        <div class="class-name">{{ $class->name }}</div>
                        <div class="class-schedule">
                            📅 {{ $class->lich_hoc }} | ⏰ {{ $class->start_time }} - {{ $class->end_time }}
                        </div>
                        <div class="class-price">💰 {{ number_format($class->price) }}₫</div>
                    </div>
                    @endforeach
                </div>
            @else
                <p style="color: #666; text-align: center; padding: 20px;">
                    Giáo viên chưa có lớp học nào
                </p>
            @endif
        </div>

        <div class="teacher-sidebar">
            <h3 class="section-title">📊 Thống kê</h3>
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-number">{{ $teacher->classes->count() }}</span>
                    <span class="stat-label">Lớp học</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">{{ $teacher->exp_year }}</span>
                    <span class="stat-label">Năm kinh nghiệm</span>
                </div>
            </div>
            
            <h3 class="section-title">📋 Thông tin liên hệ</h3>
            <div class="info-grid">
                <div class="info-item">
                    <strong>📧 Email:</strong>
                    <span>{{ $teacher->email }}</span>
                </div>
                <div class="info-item">
                    <strong>📱 Phone:</strong>
                    <span>{{ $teacher->phone }}</span>
                </div>
                <div class="info-item">
                    <strong>🎂 Sinh nhật:</strong>
                    <span>{{ $teacher->birthday ? $teacher->birthday->format('d/m/Y') : 'Chưa cập nhật' }}</span>
                </div>
                <div class="info-item">
                    <strong>🎓 Kinh nghiệm:</strong>
                    <span>{{ $teacher->exp_year }} năm</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
