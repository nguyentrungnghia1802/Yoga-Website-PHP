@extends('layouts.admin')

@section('title', 'Chi tiết Đăng ký - Admin')

@section('content')
<div class="page-header">
    <div class="header-navigation">
        <a href="{{ route('admin.registrations') }}" class="back-btn">
            ← Quay lại danh sách
        </a>
    </div>
    <div class="header-content">
        <h1>📝 Chi tiết Đăng ký #{{ $registration->id }}</h1>
        <div class="status-badge status-{{ strtolower($registration->status->value) }}">
            @switch($registration->status->value)
                @case('PENDING')
                    ⏳ Chờ duyệt
                    @break
                @case('CONFIRMED')
                    ✅ Đã duyệt
                    @break
                @case('CANCELLED')
                    ❌ Từ chối
                    @break
                @default
                    📝 {{ $registration->status->value }}
            @endswitch
        </div>
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

<div class="detail-container">
    <div class="detail-grid">
        <!-- Customer Information -->
        <div class="detail-section">
            <div class="section-header">
                <h2>👤 Thông tin học viên</h2>
            </div>
            <div class="section-content">
                <div class="customer-profile">
                    <div class="customer-avatar">
                        {{ substr($registration->customer ? $registration->customer->name : $registration->customer_name, 0, 1) }}
                    </div>
                    <div class="customer-info">
                        <h3>{{ $registration->customer ? $registration->customer->name : $registration->customer_name }}</h3>
                        <div class="info-row">
                            <span class="info-label">📧 Email:</span>
                            <span class="info-value">{{ $registration->customer ? $registration->customer->email : $registration->customer_email }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">📱 Điện thoại:</span>
                            <span class="info-value">{{ $registration->customer ? $registration->customer->phone : $registration->customer_phone }}</span>
                        </div>
                        @if($registration->customer && $registration->customer->address)
                            <div class="info-row">
                                <span class="info-label">🏠 Địa chỉ:</span>
                                <span class="info-value">{{ $registration->customer->address }}</span>
                            </div>
                        @endif
                        <div class="info-row">
                            <span class="info-label">📅 Tham gia:</span>
                            <span class="info-value">{{ $registration->customer ? $registration->customer->created_at->format('d/m/Y') : $registration->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Class Information -->
        <div class="detail-section">
            <div class="section-header">
                <h2>🧘‍♀️ Thông tin lớp học</h2>
            </div>
            <div class="section-content">
                <div class="class-info">
                    <h3>{{ $registration->class->name }}</h3>
                    <div class="info-row">
                        <span class="info-label">👨‍🏫 Giảng viên:</span>
                        <span class="info-value">{{ $registration->class->teacher->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">💰 Học phí:</span>
                        <span class="info-value">{{ number_format($registration->class->price) }} VNĐ</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">🕒 Lịch học:</span>
                        <span class="info-value">{{ $registration->class->schedule }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">👥 Sức chứa:</span>
                        <span class="info-value">{{ $registration->class->capacity }} người</span>
                    </div>
                    @if($registration->class->description)
                        <div class="info-row">
                            <span class="info-label">📝 Mô tả:</span>
                            <span class="info-value">{{ $registration->class->description }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Registration Details -->
        <div class="detail-section full-width">
            <div class="section-header">
                <h2>📋 Chi tiết đăng ký</h2>
            </div>
            <div class="section-content">
                <div class="registration-details">
                    <div class="detail-row">
                        <div class="detail-item">
                            <span class="detail-label">📅 Ngày đăng ký:</span>
                            <span class="detail-value">{{ $registration->created_at->format('d/m/Y H:i:s') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">🔄 Cập nhật lần cuối:</span>
                            <span class="detail-value">{{ $registration->updated_at->format('d/m/Y H:i:s') }}</span>
                        </div>
                    </div>
                    
                    @if($registration->note)
                        <div class="detail-row">
                            <div class="detail-item full-width">
                                <span class="detail-label">📝 Ghi chú từ học viên:</span>
                                <div class="note-content">{{ $registration->note }}</div>
                            </div>
                        </div>
                    @endif

                    @if($registration->idempotency_key)
                        <div class="detail-row">
                            <div class="detail-item">
                                <span class="detail-label">🔑 Mã định danh:</span>
                                <span class="detail-value">{{ $registration->idempotency_key }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-section">
        @if($registration->status->value === 'PENDING')
            <div class="action-group">
                <h3>⚡ Hành động nhanh</h3>
                <div class="action-buttons">
                    <form method="POST" action="{{ route('admin.registrations.approve', $registration->id) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="action-btn approve-btn" onclick="return confirm('Bạn có chắc muốn duyệt đăng ký này?')">
                            ✅ Duyệt đăng ký
                        </button>
                    </form>
                    
                    <form method="POST" action="{{ route('admin.registrations.reject', $registration->id) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="action-btn reject-btn" onclick="return confirm('Bạn có chắc muốn từ chối đăng ký này?')">
                            ❌ Từ chối đăng ký
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <div class="action-group">
            <h3>🛠️ Quản lý</h3>
            <div class="action-buttons">
                <!-- Các route show/destroy này không tồn tại trong routes/web.php -->
            </div>
        </div>
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
}

.back-btn {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    padding: 8px 16px;
    border-radius: 6px;
    background: #f8f9fa;
    transition: all 0.2s;
}

.back-btn:hover {
    background: #e9ecef;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-content h1 {
    font-size: 2rem;
    color: #333;
    margin: 0;
}

.status-badge {
    padding: 10px 20px;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: 600;
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

.detail-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.detail-section {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
}

.detail-section.full-width {
    grid-column: span 2;
}

.section-header {
    background: #f8f9fa;
    padding: 20px;
    border-bottom: 1px solid #dee2e6;
}

.section-header h2 {
    margin: 0;
    color: #333;
    font-size: 1.3rem;
}

.section-content {
    padding: 25px;
}

.customer-profile {
    display: flex;
    align-items: flex-start;
    gap: 20px;
}

.customer-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #667eea;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: bold;
    flex-shrink: 0;
}

.customer-info h3,
.class-info h3 {
    margin: 0 0 15px 0;
    color: #333;
    font-size: 1.4rem;
}

.info-row {
    display: flex;
    align-items: flex-start;
    margin-bottom: 12px;
    gap: 10px;
}

.info-label {
    font-weight: 600;
    color: #555;
    min-width: 120px;
    flex-shrink: 0;
}

.info-value {
    color: #333;
    flex: 1;
}

.registration-details {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.detail-row {
    display: flex;
    gap: 30px;
}

.detail-item {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.detail-item.full-width {
    flex: none;
    width: 100%;
}

.detail-label {
    font-weight: 600;
    color: #555;
    font-size: 0.9rem;
}

.detail-value {
    color: #333;
    font-size: 1rem;
}

.note-content {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    color: #333;
    border-left: 4px solid #667eea;
    margin-top: 5px;
}

.action-section {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.action-group h3 {
    margin: 0 0 15px 0;
    color: #333;
    font-size: 1.2rem;
}

.action-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.action-btn {
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
}

.approve-btn {
    background: #28a745;
    color: white;
}

.approve-btn:hover {
    background: #218838;
    transform: translateY(-1px);
}

.reject-btn {
    background: #dc3545;
    color: white;
}

.reject-btn:hover {
    background: #c82333;
    transform: translateY(-1px);
}

.view-btn {
    background: #17a2b8;
    color: white;
}

.view-btn:hover {
    background: #138496;
    transform: translateY(-1px);
}

.delete-btn {
    background: #6c757d;
    color: white;
}

.delete-btn:hover {
    background: #5a6268;
    transform: translateY(-1px);
}

@media (max-width: 1024px) {
    .detail-grid {
        grid-template-columns: 1fr;
    }
    
    .detail-section.full-width {
        grid-column: span 1;
    }
}

@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .customer-profile {
        flex-direction: column;
        text-align: center;
    }
    
    .detail-row {
        flex-direction: column;
        gap: 15px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .action-btn {
        justify-content: center;
    }
}
</style>
@endpush
@endsection