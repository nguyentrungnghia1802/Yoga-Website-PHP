@extends('layouts.app')

@section('title', 'Danh sách Giáo viên - Yoga/Gym Center')

@push('styles')
<style>
.teacher-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 30px;
}

.teacher-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
}

.teacher-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.teacher-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
    font-weight: bold;
    position: relative;
    overflow: hidden;
}

.teacher-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.teacher-name {
    font-size: 1.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 10px;
}

.teacher-experience {
    background: #f8f9fa;
    color: #666;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    margin-bottom: 15px;
    display: inline-block;
}

.teacher-description {
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
    font-size: 0.95rem;
}

.teacher-stats {
    display: flex;
    justify-content: space-around;
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: bold;
    color: #667eea;
    display: block;
}

.stat-label {
    font-size: 0.8rem;
    color: #666;
    margin-top: 5px;
}

.view-detail-btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 12px 24px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-block;
}

.view-detail-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    color: white;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .teacher-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .teacher-card {
        padding: 20px;
    }
    
    .teacher-avatar {
        width: 100px;
        height: 100px;
        font-size: 2.5rem;
    }
    
    .teacher-stats {
        flex-direction: column;
        gap: 10px;
    }
}
</style>
@endpush

@section('content')
<h1 class="page-title">👨‍🏫 Danh sách Giáo viên</h1>

<div class="teacher-grid">
    @forelse($teachers as $teacher)
    <div class="teacher-card">
        <div class="teacher-avatar">
            @if($teacher->avatar && file_exists(public_path('storage/' . $teacher->avatar)))
                <img src="{{ asset('storage/' . $teacher->avatar) }}" alt="{{ $teacher->name }}">
            @else
                {{ substr($teacher->name, 0, 1) }}
            @endif
        </div>
        
        <h3 class="teacher-name">{{ $teacher->name }}</h3>
        
        <div class="teacher-experience">
            🎓 {{ $teacher->exp_year }} năm kinh nghiệm
        </div>
        
        <p class="teacher-description">
            {{ $teacher->description ?? 'Giáo viên yoga chuyên nghiệp với nhiều năm kinh nghiệm giảng dạy.' }}
        </p>
        
        <div class="teacher-stats">
            <div class="stat-item">
                <span class="stat-number">{{ $teacher->classes->count() }}</span>
                <span class="stat-label">Lớp học</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ $teacher->exp_year }}</span>
                <span class="stat-label">Năm KN</span>
            </div>
        </div>
        
        <a href="{{ route('teacher.detail', $teacher->id) }}" class="view-detail-btn">
            👁️ Xem chi tiết
        </a>
    </div>
    @empty
    <div class="empty-state">
        <div class="empty-icon">👨‍🏫</div>
        <h3>Chưa có giáo viên nào</h3>
        <p>Hiện tại chưa có giáo viên nào trong hệ thống.</p>
    </div>
    @endforelse
</div>
@endsection
