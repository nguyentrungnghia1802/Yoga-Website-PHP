@extends('layouts.admin')

@section('title', 'Quản lý Đăng ký - Admin')

@section('content')
<div class="page-header">
    <div class="header-content">
        <h1><i class="fas fa-file-alt"></i> Quản lý Đăng ký</h1>
        <p>Duyệt và quản lý các đăng ký lớp học</p>
    </div>
    <div class="header-actions">
        <div class="search-form">
            <form method="GET" action="{{ route('admin.registrations') }}">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Tìm kiếm theo tên, email, lớp học..." class="search-input">
                <button type="submit" class="search-btn">Tìm kiếm</button>
            </form>
        </div>
        <a href="{{ route('admin.registrations.create') }}" class="create-btn">
            <i class="fas fa-plus"></i> Tạo đơn đăng ký
        </a>
    </div>
    <div class="filter-buttons">
        <a href="{{ route('admin.registrations') }}" class="filter-btn {{ request('status') == '' ? 'active' : '' }}">
            Tất cả
        </a>
        <a href="{{ route('admin.registrations', ['status' => 'pending']) }}" class="filter-btn {{ request('status') == 'pending' ? 'active' : '' }}">
            Chờ duyệt ({{ $stats['pending'] ?? 0 }})
        </a>
        <a href="{{ route('admin.registrations', ['status' => 'confirmed']) }}" class="filter-btn {{ request('status') == 'confirmed' ? 'active' : '' }}">
            Đã duyệt ({{ $stats['approved'] ?? 0 }})
        </a>
        <a href="{{ route('admin.registrations', ['status' => 'cancelled']) }}" class="filter-btn {{ request('status') == 'cancelled' ? 'active' : '' }}">
            Từ chối ({{ $stats['rejected'] ?? 0 }})
        </a>
    </div>
</div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error">
        <i class="fas fa-times-circle"></i> {{ session('error') }}
    </div>
@endif

<div class="registrations-container">
    @forelse($registrations as $registration)
        <div class="registration-card">
            <div class="registration-main">
                <div class="customer-info">
                    <div class="customer-avatar">
                        {{ substr($registration->customer->name ?? 'N/A', 0, 1) }}
                    </div>
                    <div class="customer-details">
                        <h3>{{ $registration->customer->name ?? 'Không có thông tin' }}</h3>
                        <p><i class="fas fa-envelope"></i> {{ $registration->customer->email ?? 'Không có email' }}</p>
                        <p><i class="fas fa-phone"></i> {{ $registration->customer->phone ?? 'Không có SĐT' }}</p>
                    </div>
                </div>
                
                <div class="class-info">
                    <h4><i class="fas fa-dumbbell"></i> {{ $registration->class->name }}</h4>
                    <p><i class="fas fa-chalkboard-teacher"></i> {{ $registration->class->teacher->name }}</p>
                    <p><i class="fas fa-dollar-sign"></i> {{ number_format($registration->class->price) }} VNĐ</p>
                    <p><i class="fas fa-clock"></i> {{ $registration->class->schedule }}</p>
                </div>
                
                <div class="registration-meta">
                    <div class="status-badge status-{{ strtolower($registration->status->value) }}">
                        @switch($registration->status->value)
                            @case('PENDING')
                                <i class="fas fa-clock"></i> Chờ duyệt
                                @break
                            @case('CONFIRMED')
                                <i class="fas fa-check-circle"></i> Đã duyệt
                                @break
                            @case('CANCELLED')
                                <i class="fas fa-times-circle"></i> Từ chối
                                @break
                            @default
                                <i class="fas fa-file-alt"></i> {{ $registration->status->value }}
                        @endswitch
                    </div>
                    <div class="registration-date">
                        <i class="fas fa-calendar"></i> {{ $registration->created_at->format('d/m/Y H:i') }}
                    </div>
                    @if($registration->note)
                        <div class="registration-note">
                            <i class="fas fa-sticky-note"></i> {{ $registration->note }}
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="registration-actions">
                @if($registration->status->value === 'PENDING')
                    <form method="POST" action="{{ route('admin.registrations.approve', $registration->id) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="action-btn approve-btn" onclick="return confirm('Bạn có chắc muốn duyệt đăng ký này?')">
                            <i class="fas fa-check"></i> Duyệt
                        </button>
                    </form>
                    
                    <form method="POST" action="{{ route('admin.registrations.reject', $registration->id) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="action-btn reject-btn" onclick="return confirm('Bạn có chắc muốn từ chối đăng ký này?')">
                            <i class="fas fa-times"></i> Từ chối
                        </button>
                    </form>
                @endif
                
                <a href="{{ route('admin.registrations.detail', $registration->id) }}" class="action-btn view-btn">
                    <i class="fas fa-eye"></i> Chi tiết
                </a>
                
                <!-- Xóa đăng ký: Route destroy chưa định nghĩa trong routes/web.php -->
                <!--
                <form method="POST" action="#" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn delete-btn" onclick="return confirm('Bạn có chắc muốn xóa đăng ký này? Hành động này không thể hoàn tác!')">
                        🗑️ Xóa
                    </button>
                </form>
                -->
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-icon">📭</div>
            <h3>Không có đăng ký nào</h3>
            <p>
                @if(request('status'))
                    Không có đăng ký nào với trạng thái "{{ ucfirst(request('status')) }}"
                @else
                    Chưa có ai đăng ký lớp học nào cả
                @endif
            </p>
        </div>
    @endforelse
</div>

@if($registrations->hasPages())
    <div class="pagination-wrapper">
        {{ $registrations->links() }}
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

.header-content h1 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 5px;
}

.header-content p {
    color: #666;
    margin: 0;
}

.filter-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 15px;
}

.filter-btn {
    padding: 8px 16px;
    border-radius: 20px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.2s;
    background: #f8f9fa;
    color: #666;
}

.filter-btn:hover {
    background: #e9ecef;
    color: #333;
}

.filter-btn.active {
    background: #667eea;
    color: white;
}

.search-form {
    margin-bottom: 15px;
}

.search-form form {
    display: flex;
    gap: 10px;
}

.search-input {
    flex: 1;
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

.registrations-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.registration-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.2s;
}

.registration-card:hover {
    transform: translateY(-2px);
}

.registration-main {
    padding: 25px;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 25px;
    align-items: start;
}

.customer-info {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.customer-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #667eea;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    font-weight: bold;
    flex-shrink: 0;
}

.customer-details h3 {
    margin: 0 0 8px 0;
    color: #333;
    font-size: 1.1rem;
}

.customer-details p {
    margin: 3px 0;
    color: #666;
    font-size: 0.9rem;
}

.class-info h4 {
    margin: 0 0 10px 0;
    color: #333;
    font-size: 1.1rem;
}

.class-info p {
    margin: 5px 0;
    color: #666;
    font-size: 0.9rem;
}

.registration-meta {
    text-align: right;
}

.status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    margin-bottom: 10px;
}

.status-pending {
    background: #fff3cd;
    color: #856404;
}

.status-confirmed {
    background: #d4edda;
    color: #155724;
}

.status-cancelled {
    background: #f8d7da;
    color: #721c24;
}

.registration-date {
    color: #999;
    font-size: 0.8rem;
    margin-bottom: 5px;
}

.registration-note {
    color: #666;
    font-size: 0.8rem;
    font-style: italic;
    margin-top: 8px;
    padding: 8px;
    background: #f8f9fa;
    border-radius: 6px;
}

.registration-actions {
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

.approve-btn {
    background: #28a745;
    color: white;
}

.approve-btn:hover {
    background: #218838;
}

.reject-btn {
    background: #dc3545;
    color: white;
}

.reject-btn:hover {
    background: #c82333;
}

.view-btn {
    background: #17a2b8;
    color: white;
}

.view-btn:hover {
    background: #138496;
}

.delete-btn {
    background: #6c757d;
    color: white;
}

.delete-btn:hover {
    background: #5a6268;
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
}

.pagination-wrapper {
    margin-top: 30px;
    display: flex;
    justify-content: center;
}

@media (max-width: 1024px) {
    .registration-main {
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
    .registration-meta {
        grid-column: span 2;
        text-align: left;
    }
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 20px;
    }
    
    .registration-main {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .registration-meta {
        grid-column: span 1;
        text-align: left;
    }
    
    .registration-actions {
        flex-direction: column;
    }
    
    .action-btn {
        justify-content: center;
    }
}
</style>
@endpush
@endsection