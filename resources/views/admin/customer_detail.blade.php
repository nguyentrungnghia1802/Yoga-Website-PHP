@extends('layouts.admin')

@section('title', 'Chi tiết Học viên - Admin')

@section('content')
<div class="page-header">
    <div class="header-navigation">
        <a href="{{ route('admin.customers') }}" class="back-btn">
            ← Quay lại danh sách
        </a>
    </div>
    <div class="header-content">
        <h1>👤 Chi tiết Học viên: {{ $customer->name }}</h1>
    </div>
</div>

<div class="detail-container">
    <div class="detail-grid">
        <!-- Customer Information -->
        <div class="detail-section">
            <div class="section-header">
                <h2>📋 Thông tin học viên</h2>
            </div>
            <div class="section-content">
                <div class="customer-profile">
                    <div class="customer-avatar">
                        {{ substr($customer->name, 0, 1) }}
                    </div>
                    <div class="customer-info">
                        <h3>{{ $customer->name }}</h3>
                        <div class="info-row">
                            <span class="info-label">📧 Email:</span>
                            <span class="info-value">{{ $customer->email }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">📱 Điện thoại:</span>
                            <span class="info-value">{{ $customer->phone }}</span>
                        </div>
                        @if($customer->birthday)
                            <div class="info-row">
                                <span class="info-label">🎂 Ngày sinh:</span>
                                <span class="info-value">{{ \Carbon\Carbon::parse($customer->birthday)->format('d/m/Y') }}</span>
                            </div>
                        @endif
                        @if($customer->gender)
                            <div class="info-row">
                                <span class="info-label">👥 Giới tính:</span>
                                <span class="info-value">{{ $customer->gender === 'male' ? 'Nam' : 'Nữ' }}</span>
                            </div>
                        @endif
                        @if($customer->address)
                            <div class="info-row">
                                <span class="info-label">🏠 Địa chỉ:</span>
                                <span class="info-value">{{ $customer->address }}</span>
                            </div>
                        @endif
                        <div class="info-row">
                            <span class="info-label">📅 Tham gia:</span>
                            <span class="info-value">{{ $customer->created_at->format('d/m/Y') }}</span>
                        </div>
                        @if($customer->note)
                            <div class="info-row">
                                <span class="info-label">📝 Ghi chú:</span>
                                <span class="info-value">{{ $customer->note }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Registration History -->
        <div class="detail-section">
            <div class="section-header">
                <h2>📚 Lịch sử đăng ký ({{ $registrations->count() }})</h2>
            </div>
            <div class="section-content">
                @forelse($registrations as $registration)
                    <div class="registration-item">
                        <div class="registration-info">
                            <div class="class-name">🧘‍♀️ {{ $registration->class->name }}</div>
                            <div class="teacher-name">👨‍🏫 {{ $registration->class->teacher->name }}</div>
                            <div class="registration-date">📅 {{ $registration->created_at->format('d/m/Y H:i') }}</div>
                            <div class="price">💰 {{ number_format($registration->final_price) }} VNĐ</div>
                        </div>
                        <div class="registration-status">
                            <div class="status-badge status-{{ strtolower($registration->status->value) }}">
                                @switch($registration->status->value)
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
                                        📝 {{ $registration->status->value }}
                                @endswitch
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <p>📭 Học viên chưa đăng ký lớp học nào</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="action-buttons">
        <a href="{{ route('admin.customers.edit', $customer) }}" class="action-btn edit-btn">
            ✏️ Chỉnh sửa thông tin
        </a>
        <a href="{{ route('admin.customers') }}" class="action-btn secondary-btn">
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

.customer-profile {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    margin-bottom: 20px;
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

.customer-info h3 {
    margin: 0 0 15px 0;
    color: #333;
    font-size: 1.5rem;
}

.info-row {
    display: flex;
    margin-bottom: 12px;
    align-items: flex-start;
}

.info-label {
    min-width: 120px;
    font-weight: 600;
    color: #666;
    flex-shrink: 0;
}

.info-value {
    color: #333;
    flex: 1;
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

.class-name {
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.teacher-name {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 3px;
}

.registration-date {
    color: #999;
    font-size: 0.8rem;
    margin-bottom: 3px;
}

.price {
    color: #28a745;
    font-weight: 500;
    font-size: 0.9rem;
}

.status-badge {
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
    
    .customer-profile {
        flex-direction: column;
        text-align: center;
    }
    
    .registration-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
}
</style>
@endpush
@endsection