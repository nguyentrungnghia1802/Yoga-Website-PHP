@extends('layouts.admin')

@section('title', 'Quản lý Lớp học - Admin')

@section('content')
<div class="page-header">
    <div class="header-content">
        <h1>🧘‍♀️ Quản lý Lớp học</h1>
        <p>Tạo và quản lý các lớp học Yoga/Gym</p>
    </div>
    <div class="header-actions">
        <a href="{{ route('admin.classes.create') }}" class="create-btn">
            ➕ Tạo lớp học mới
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        ✅ {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error">
        ❌ {{ session('error') }}
    </div>
@endif

<div class="classes-container">
    @forelse($classes as $class)
        <div class="class-card">
            <div class="class-main">
                <div class="class-info">
                    <h3>{{ $class->name }}</h3>
                    <div class="class-details">
                        <div class="detail-item">
                            <span class="detail-icon">👨‍🏫</span>
                            <span>{{ $class->teacher->name }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-icon">💰</span>
                            <span>{{ number_format($class->price) }} VNĐ</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-icon">🕒</span>
                            <span>{{ $class->schedule }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-icon">👥</span>
                            <span>{{ $class->registrations_count ?? 0 }}/{{ $class->capacity }} học viên</span>
                        </div>
                    </div>
                    @if($class->description)
                        <div class="class-description">
                            {{ Str::limit($class->description, 100) }}
                        </div>
                    @endif
                </div>
                
                <div class="class-stats">
                    <div class="stat-item">
                        <div class="stat-number">{{ $class->registrations_count ?? 0 }}</div>
                        <div class="stat-label">Đăng ký</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $class->capacity - ($class->registrations_count ?? 0) }}</div>
                        <div class="stat-label">Còn trống</div>
                    </div>
                    <div class="class-status {{ ($class->registrations_count ?? 0) >= $class->capacity ? 'full' : 'available' }}">
                        @if(($class->registrations_count ?? 0) >= $class->capacity)
                            🔴 Đã đầy
                        @else
                            🟢 Còn chỗ
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="class-actions">
                <a href="{{ route('admin.classes.show', $class) }}" class="action-btn view-btn">
                    👁️ Xem chi tiết
                </a>
                <a href="{{ route('admin.classes.edit', $class) }}" class="action-btn edit-btn">
                    ✏️ Chỉnh sửa
                </a>
                <form method="POST" action="{{ route('admin.classes.destroy', $class) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn delete-btn" onclick="return confirm('Bạn có chắc muốn xóa lớp học này? Tất cả đăng ký liên quan cũng sẽ bị xóa!')">
                        🗑️ Xóa
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-icon">🧘‍♀️</div>
            <h3>Chưa có lớp học nào</h3>
            <p>Tạo lớp học đầu tiên để bắt đầu nhận đăng ký từ học viên</p>
            <a href="{{ route('admin.classes.create') }}" class="create-btn">
                ➕ Tạo lớp học đầu tiên
            </a>
        </div>
    @endforelse
</div>

@if($classes->hasPages())
    <div class="pagination-wrapper">
        {{ $classes->links() }}
    </div>
@endif

@push('styles')
<style>
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 30px;
    padding: 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.header-content h1 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 5px;
}

.header-content p {
    color: #666;
    margin: 0;
}

.create-btn {
    background: #28a745;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.create-btn:hover {
    background: #218838;
    transform: translateY(-1px);
}

.alert {
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 500;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.classes-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.class-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.2s;
}

.class-card:hover {
    transform: translateY(-2px);
}

.class-main {
    padding: 25px;
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 30px;
    align-items: start;
}

.class-info h3 {
    margin: 0 0 15px 0;
    color: #333;
    font-size: 1.4rem;
}

.class-details {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-bottom: 15px;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #666;
    font-size: 0.9rem;
}

.detail-icon {
    font-size: 1rem;
    width: 20px;
    text-align: center;
}

.class-description {
    color: #666;
    font-size: 0.9rem;
    line-height: 1.5;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 6px;
    border-left: 4px solid #667eea;
}

.class-stats {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
    text-align: center;
}

.stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.stat-number {
    font-size: 1.8rem;
    font-weight: bold;
    color: #333;
}

.stat-label {
    font-size: 0.8rem;
    color: #666;
    margin-top: 2px;
}

.class-status {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
}

.class-status.available {
    background: #d4edda;
    color: #155724;
}

.class-status.full {
    background: #f8d7da;
    color: #721c24;
}

.class-actions {
    padding: 15px 25px;
    background: #f8f9fa;
    border-top: 1px solid #dee2e6;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.action-btn {
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all 0.2s;
}

.view-btn {
    background: #17a2b8;
    color: white;
}

.view-btn:hover {
    background: #138496;
}

.edit-btn {
    background: #ffc107;
    color: #212529;
}

.edit-btn:hover {
    background: #e0a800;
}

.delete-btn {
    background: #dc3545;
    color: white;
}

.delete-btn:hover {
    background: #c82333;
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 20px;
}

.empty-state h3 {
    color: #333;
    margin-bottom: 10px;
}

.empty-state p {
    color: #666;
    margin-bottom: 20px;
}

.pagination-wrapper {
    margin-top: 30px;
    display: flex;
    justify-content: center;
}

@media (max-width: 1024px) {
    .class-main {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .class-stats {
        flex-direction: row;
        justify-content: space-around;
    }
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 20px;
    }
    
    .class-details {
        grid-template-columns: 1fr;
    }
    
    .class-actions {
        flex-direction: column;
    }
    
    .action-btn {
        justify-content: center;
    }
}
</style>
@endpush
@endsection