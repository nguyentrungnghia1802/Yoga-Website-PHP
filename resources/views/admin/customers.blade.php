@extends('layouts.admin')

@section('title', 'Quản lý Học viên - Admin')

@section('content')
<div class="page-header">
    <div class="header-content">
        <h1>👥 Quản lý Học viên</h1>
        <p>Quản lý thông tin các học viên đăng ký lớp học</p>
    </div>
    <div class="header-actions">
        <div class="search-form">
            <form method="GET" action="{{ route('admin.customers') }}">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Tìm kiếm theo tên, email, số điện thoại..." class="search-input">
                <button type="submit" class="search-btn">Tìm kiếm</button>
            </form>
        </div>
        <a href="{{ route('admin.customers.create') }}" class="create-btn">
            ➕ Thêm học viên mới
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

<div class="customers-container">
    @forelse($customers as $customer)
        <div class="customer-card">
            <div class="customer-main">
                <div class="customer-info">
                    <div class="customer-avatar">
                        {{ substr($customer->name, 0, 1) }}
                    </div>
                    <div class="customer-details">
                        <h3>{{ $customer->name }}</h3>
                        <div class="detail-item">
                            <span class="detail-icon">📧</span>
                            <span>{{ $customer->email }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-icon">📱</span>
                            <span>{{ $customer->phone }}</span>
                        </div>
                        @if($customer->address)
                            <div class="detail-item">
                                <span class="detail-icon">🏠</span>
                                <span>{{ Str::limit($customer->address, 50) }}</span>
                            </div>
                        @endif
                        <div class="detail-item">
                            <span class="detail-icon">📅</span>
                            <span>Tham gia: {{ $customer->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="customer-stats">
                    <div class="stat-item">
                        <div class="stat-number">{{ $customer->registrations_count ?? 0 }}</div>
                        <div class="stat-label">Lớp đã đăng ký</div>
                    </div>
                    @if($customer->birthday)
                        <div class="detail-item">
                            <span class="detail-icon">🎂</span>
                            <span>{{ \Carbon\Carbon::parse($customer->birthday)->format('d/m/Y') }}</span>
                        </div>
                    @endif
                    @if($customer->gender)
                        <div class="detail-item">
                            <span class="detail-icon">{{ $customer->gender === 'male' ? '👨' : '👩' }}</span>
                            <span>{{ $customer->gender === 'male' ? 'Nam' : 'Nữ' }}</span>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="customer-actions">
                <a href="{{ route('admin.customers.detail', $customer) }}" class="action-btn view-btn">
                    👁️ Xem chi tiết
                </a>
                <a href="{{ route('admin.customers.edit', $customer) }}" class="action-btn edit-btn">
                    ✏️ Chỉnh sửa
                </a>
                <form method="POST" action="{{ route('admin.customers.delete', $customer) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn delete-btn" onclick="return confirm('Bạn có chắc muốn xóa học viên này? Tất cả đăng ký liên quan cũng sẽ bị xóa!')">
                        🗑️ Xóa
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-icon">👥</div>
            <h3>Chưa có học viên nào</h3>
            <p>Thêm học viên đầu tiên để bắt đầu quản lý</p>
            <a href="{{ route('admin.customers.create') }}" class="create-btn">
                ➕ Thêm học viên đầu tiên
            </a>
        </div>
    @endforelse
</div>

@if($customers->hasPages())
    <div class="pagination-wrapper">
        {{ $customers->links() }}
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

.customers-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.customer-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.2s;
}

.customer-card:hover {
    transform: translateY(-2px);
}

.customer-main {
    padding: 25px;
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 25px;
    align-items: start;
}

.customer-info {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.customer-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #667eea;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: bold;
    flex-shrink: 0;
}

.customer-details h3 {
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

.customer-stats {
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

.customer-actions {
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
    
    .customer-main {
        grid-template-columns: 1fr;
    }
    
    .customer-stats {
        text-align: left;
    }
    
    .customer-actions {
        flex-direction: column;
    }
    
    .action-btn {
        justify-content: center;
    }
}
</style>
@endpush
@endsection