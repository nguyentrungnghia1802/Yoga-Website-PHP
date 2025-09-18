@extends('layouts.app')

@section('title', 'Chi tiết lớp học - ' . $class->name)

@push('styles')
<style>
.class-detail-container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
}

.class-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 40px;
    border-radius: 15px;
    margin-bottom: 30px;
    text-align: center;
}

.class-header h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
    font-weight: 700;
}

.class-header .class-meta {
    font-size: 1.1rem;
    opacity: 0.9;
}

.class-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 30px;
    margin-bottom: 40px;
}

.class-info {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.07);
}

.class-sidebar {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.07);
    height: fit-content;
}

.info-section {
    margin-bottom: 30px;
}

.info-section h3 {
    color: #333;
    font-size: 1.3rem;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
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

.teacher-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
    margin-bottom: 20px;
}

.teacher-avatar {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    font-weight: bold;
}

.teacher-info h4 {
    margin: 0 0 5px 0;
    color: #333;
}

.teacher-info p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
}

.students-list {
    max-height: 300px;
    overflow-y: auto;
}

.student-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.student-item:last-child {
    border-bottom: none;
}

.student-avatar {
    width: 35px;
    height: 35px;
    background: #e9ecef;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: #495057;
}

.availability {
    text-align: center;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.availability.available {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.availability.full {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.register-btn {
    width: 100%;
    padding: 15px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.2s;
}

.register-btn:hover {
    transform: translateY(-2px);
}

.register-btn:disabled {
    background: #6c757d;
    cursor: not-allowed;
    transform: none;
}

@media (max-width: 768px) {
    .class-content {
        grid-template-columns: 1fr;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .class-header h1 {
        font-size: 2rem;
    }
}
</style>
@endpush

@section('content')
<div class="class-detail-container">
    <div class="class-header">
        <h1>{{ $class->name }}</h1>
        <div class="class-meta">
            <span>🧘‍♀️ {{ $class->teacher->name }}</span> • 
            <span>📅 {{ $class->lich_hoc }}</span> • 
            <span>📍 {{ $class->location }}</span>
        </div>
    </div>

    <div class="class-content">
        <div class="class-info">
            <div class="info-section">
                <h3>📋 Thông tin lớp học</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span>⏰</span>
                        <div>
                            <strong>Thời gian:</strong>
                            {{ $class->start_time }} - {{ $class->end_time }}
                        </div>
                    </div>
                    <div class="info-item">
                        <span>📅</span>
                        <div>
                            <strong>Lịch học:</strong>
                            {{ $class->lich_hoc }}
                        </div>
                    </div>
                    <div class="info-item">
                        <span>📍</span>
                        <div>
                            <strong>Địa điểm:</strong>
                            {{ $class->location }}
                        </div>
                    </div>
                    <div class="info-item">
                        <span>💰</span>
                        <div>
                            <strong>Học phí:</strong>
                            {{ number_format($class->price, 0, ',', '.') }} VNĐ
                        </div>
                    </div>
                    <div class="info-item">
                        <span>📊</span>
                        <div>
                            <strong>Sĩ số:</strong>
                            {{ $registeredStudents->count() }}/{{ $class->quantity }} học viên
                        </div>
                    </div>
                    <div class="info-item">
                        <span>📆</span>
                        <div>
                            <strong>Thời gian:</strong>
                            {{ $class->start_date }} đến {{ $class->end_date }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-section">
                <h3>👨‍🏫 Giảng viên</h3>
                <div class="teacher-card">
                    <div class="teacher-avatar">
                        {{ substr($class->teacher->name, 0, 1) }}
                    </div>
                    <div class="teacher-info">
                        <h4>{{ $class->teacher->name }}</h4>
                        <p>📞 {{ $class->teacher->phone }} • ✉️ {{ $class->teacher->email }}</p>
                        <p>🎓 {{ $class->teacher->exp_year }} năm kinh nghiệm</p>
                        <p>{{ $class->teacher->description }}</p>
                    </div>
                </div>
            </div>

            <div class="info-section">
                <h3>📝 Mô tả lớp học</h3>
                <p style="line-height: 1.6; color: #666;">
                    {{ $class->description ?: 'Chưa có mô tả chi tiết cho lớp học này.' }}
                </p>
            </div>
        </div>

        <div class="class-sidebar">
            <div class="availability {{ $availableSlots > 0 ? 'available' : 'full' }}">
                @if($availableSlots > 0)
                    <h4>✅ Còn {{ $availableSlots }} chỗ trống</h4>
                    <p>Đăng ký ngay để không bỏ lỡ cơ hội!</p>
                @else
                    <h4>❌ Lớp học đã đầy</h4>
                    <p>Vui lòng chọn lớp học khác hoặc liên hệ để được hỗ trợ.</p>
                @endif
            </div>

            <button class="register-btn" 
                    onclick="window.location.href='{{ route('register') }}'"
                    {{ $availableSlots <= 0 ? 'disabled' : '' }}>
                @if($availableSlots > 0)
                    📝 Đăng ký ngay
                @else
                    😔 Lớp đã đầy
                @endif
            </button>

            <div class="info-section" style="margin-top: 30px;">
                <h3>👥 Danh sách học viên ({{ $registeredStudents->count() }})</h3>
                <div class="students-list">
                    @forelse($registeredStudents as $student)
                        <div class="student-item">
                            <div class="student-avatar">
                                {{ substr($student->name, 0, 1) }}
                            </div>
                            <div>
                                <strong>{{ $student->name }}</strong>
                                <div style="font-size: 0.85rem; color: #666;">
                                    {{ $student->phone }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; color: #999; padding: 20px;">
                            <p>👤 Chưa có học viên nào đăng ký</p>
                            <p style="font-size: 0.9rem;">Hãy là người đầu tiên đăng ký lớp này!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div style="text-align: center; margin-top: 40px;">
        <a href="{{ route('classes') }}" class="btn" style="padding: 12px 30px; background: #f8f9fa; color: #495057; text-decoration: none; border-radius: 8px; display: inline-block;">
            ← Quay lại danh sách lớp học
        </a>
    </div>
</div>
@endsection