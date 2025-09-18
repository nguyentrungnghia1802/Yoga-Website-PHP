@extends('layouts.admin')

@section('title', 'Quản lý Giảng viên - Admin')

@section('content')
<div class="page-header">
    <div class="header-content">
        <h1>👨‍🏫 Quản lý Giảng viên</h1>
        <p>Quản lý thông tin các giảng viên dạy lớp học</p>
    </div>
    <div class="header-actions">
        <div class="search-form">
            <form method="GET" action="{{ route('admin.teachers') }}">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Tìm kiếm theo tên, email, kinh nghiệm..." class="search-input">
                <button type="submit" class="search-btn">Tìm kiếm</button>
            </form>
        </div>
        <a href="{{ route('admin.teachers.create') }}" class="create-btn">
            ➕ Thêm giảng viên mới
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

<div class="teachers-container">
    @forelse($teachers as $teacher)
        <div class="teacher-card">
            <div class="teacher-main">
                <div class="teacher-info">
                    <div class="teacher-avatar">
                        {{ substr($teacher->name, 0, 1) }}
                    </div>
                    <div class="teacher-details">
                        <h3>{{ $teacher->name }}</h3>
                        <div class="detail-item">
                            <span class="detail-icon">📧</span>
                            <span>{{ $teacher->email }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-icon">📱</span>
                            <span>{{ $teacher->phone }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-icon">🎓</span>
                            <span>{{ $teacher->exp_year }} năm kinh nghiệm</span>
                        </div>
                        @if($teacher->description)
                            <div class="teacher-description">
                                {{ Str::limit($teacher->description, 100) }}
                            </div>
                        @endif
                        <div class="detail-item">
                            <span class="detail-icon">📅</span>
                            <span>Gia nhập: {{ $teacher->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="teacher-stats">
                    <div class="stat-item">
                        <div class="stat-number">{{ $teacher->classes_count ?? 0 }}</div>
                        <div class="stat-label">Lớp đang dạy</div>
                    </div>
                    @if($teacher->birthday)
                        <div class="detail-item">
                            <span class="detail-icon">🎂</span>
                            <span>{{ \Carbon\Carbon::parse($teacher->birthday)->format('d/m/Y') }}</span>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="teacher-actions">
                <a href="{{ route('admin.teachers.detail', $teacher->id) }}" class="action-btn view-btn">
                    👁️ Xem chi tiết
                </a>
                <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="action-btn edit-btn">
                    ✏️ Chỉnh sửa
                </a>
                <form method="POST" action="{{ route('admin.teachers.delete', $teacher->id) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn delete-btn" onclick="return confirm('Bạn có chắc muốn xóa giảng viên này? Tất cả lớp học liên quan cũng sẽ bị ảnh hưởng!')">
                        🗑️ Xóa
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-icon">👨‍🏫</div>
            <h3>Chưa có giảng viên nào</h3>
            <p>Thêm giảng viên đầu tiên để bắt đầu tạo lớp học</p>
            <a href="{{ route('admin.teachers.create') }}" class="create-btn">
                ➕ Thêm giảng viên đầu tiên
            </a>
        </div>
    @endforelse
</div>

@if($teachers->hasPages())
    <div class="pagination-wrapper">
        {{ $teachers->links() }}
    </div>
@endif

@push('styles')
<style>
.page-header {
    margin-bottom: 30px;
    padding: 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.header-actions {
    margin-top: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
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

.header-actions {
    display: flex;
    flex-direction: column;
    gap: 15px;
    align-items: flex-end;
}

.search-form form {
    display: flex;
    gap: 10px;
}

.search-input {
    width: 300px;
    padding: 8px 15px;
    border: 2px solid #e9ecef;
    border-radius: 6px;
    font-size: 0.9rem;
}

.search-input:focus {
    outline: none;
    border-color: #667eea;
}

.search-btn {
    padding: 8px 16px;
    background: #667eea;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 0.9rem;
    cursor: pointer;
    transition: background 0.2s;
}

.search-btn:hover {
    background: #5a6fd8;
}

.create-btn {
    background: #28a745;
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: background 0.2s;
}

.create-btn:hover {
    background: #218838;
    color: white;
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

.teachers-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.teacher-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.2s;
}

.teacher-card:hover {
    transform: translateY(-2px);
}

.teacher-main {
    padding: 25px;
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 25px;
    align-items: start;
}

.teacher-info {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.teacher-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #fd7e14;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: bold;
    flex-shrink: 0;
}

.teacher-details h3 {
    margin: 0 0 10px 0;
    color: #333;
    font-size: 1.3rem;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 5px;
    color: #666;
    font-size: 0.9rem;
}

.detail-icon {
    width: 20px;
    text-align: center;
}

.teacher-description {
    margin: 10px 0;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 6px;
    color: #666;
    font-style: italic;
    font-size: 0.9rem;
}

.teacher-stats {
    text-align: right;
}

.stat-item {
    text-align: center;
    padding: 15px;
    border-radius: 8px;
    background: #f8f9fa;
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
    font-size: 0.85rem;
}

.teacher-actions {
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

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 20px;
    }
    
    .header-actions {
        align-items: stretch;
    }
    
    .search-input {
        width: 100%;
    }
    
    .teacher-main {
        grid-template-columns: 1fr;
    }
    
    .teacher-stats {
        text-align: left;
    }
    
    .teacher-actions {
        flex-direction: column;
    }
    
    .action-btn {
        justify-content: center;
    }
}
</style>
@endpush
@endsection