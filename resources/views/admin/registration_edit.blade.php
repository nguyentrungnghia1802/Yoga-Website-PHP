@extends('layouts.admin')

@section('title', 'Sửa đơn đăng ký')

@section('content')
<div class="page-header">
    <div class="header-navigation">
        <a href="{{ route('admin.registrations') }}" class="back-btn">
            ← Quay lại danh sách
        </a>
    </div>
    <div class="header-content">
        <h1>✏️ Sửa đơn đăng ký #{{ $registration->id }}</h1>
        <p>Cập nhật thông tin đăng ký cho học viên</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        ✅ {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-error">
        ❌ Vui lòng kiểm tra lại thông tin:
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-container">
    <div class="card">
        <h2 style="text-align: center; color: #667eea; margin-bottom: 30px;">Thông tin đăng ký</h2>
        <form id="registerForm" method="POST" action="{{ route('admin.registrations.update', $registration->id) }}" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="fullname">👤 Họ và tên *</label>
                <input type="text" id="fullname" name="name" required placeholder="Nhập họ và tên đầy đủ" value="{{ old('name', $registration->customer->name) }}">
            </div>
            <div class="form-group">
                <label for="email">📧 Email *</label>
                <input type="email" id="email" name="email" required placeholder="example@email.com" value="{{ old('email', $registration->customer->email) }}">
            </div>
            <div class="form-group">
                <label for="phone">📱 Số điện thoại *</label>
                <input type="tel" id="phone" name="phone" required placeholder="0909123456" value="{{ old('phone', $registration->customer->phone) }}">
            </div>
            <div class="form-group">
                <label for="class_id">🏃‍♀️ Chọn lớp học *</label>
                <select id="class_id" name="class_id" required>
                    <option value="">-- Chọn lớp học --</option>
                    @foreach($classes as $class)
                        @if(!$class->is_full || old('class_id', $registration->class_id) == $class->id)
                            <option value="{{ $class->id }}" data-price="{{ $class->price }}" 
                                    {{ old('class_id', $registration->class_id) == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            
            <!-- Package Selection -->
            <div class="form-group" id="packageGroup" style="display: none;">
                <label for="package_months">📦 Chọn gói học *</label>
                <select id="package_months" name="package_months" required>
                    <option value="">-- Chọn gói học --</option>
                    <option value="1" {{ old('package_months', $registration->package_months) == 1 ? 'selected' : '' }}>1 tháng (0% giảm giá)</option>
                    <option value="3" {{ old('package_months', $registration->package_months) == 3 ? 'selected' : '' }}>3 tháng (5% giảm giá)</option>
                    <option value="6" {{ old('package_months', $registration->package_months) == 6 ? 'selected' : '' }}>6 tháng (10% giảm giá)</option>
                    <option value="12" {{ old('package_months', $registration->package_months) == 12 ? 'selected' : '' }}>12 tháng (15% giảm giá)</option>
                </select>
            </div>
            
            <!-- Price Display -->
            <div class="form-group" id="priceDisplay" style="display: none;">
                <div class="price-info" style="background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid #667eea;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                        <span>💰 Giá gốc:</span>
                        <span id="originalPrice">0₫</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                        <span>🎯 Giảm giá:</span>
                        <span id="discountAmount" style="color: #28a745;">0₫</span>
                    </div>
                    <hr style="margin: 10px 0;">
                    <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 18px; color: #667eea;">
                        <span>💳 Tổng thanh toán:</span>
                        <span id="finalPrice">0₫</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="experience">🎯 Kinh nghiệm</label>
                <select id="experience" name="experience">
                    <option value="beginner" {{ old('experience') == 'beginner' ? 'selected' : '' }}>🌱 Người mới bắt đầu</option>
                    <option value="intermediate" {{ old('experience') == 'intermediate' ? 'selected' : '' }}>🌿 Trung bình</option>
                    <option value="advanced" {{ old('experience') == 'advanced' ? 'selected' : '' }}>🌳 Nâng cao</option>
                </select>
            </div>
            <div class="form-group">
                <label for="notes">📝 Ghi chú</label>
                <textarea id="notes" name="notes" rows="3" placeholder="Yêu cầu đặc biệt hoặc thông tin bổ sung...">{{ old('notes', $registration->note) }}</textarea>
            </div>
            
            <div class="checkbox-group">
                <label for="admin_confirm">✅ Cập nhật đơn đăng ký (Admin)</label>
            </div>
            
            <button type="submit" class="btn btn-primary btn-full">🎯 Cập nhật đơn đăng ký</button>
        </form>
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
    margin-bottom: 5px;
}

.header-content p {
    color: #666;
    margin: 0;
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

.alert ul {
    margin: 10px 0 0 20px;
}

.form-container {
    max-width: 600px;
    margin: 0 auto;
}

.card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 30px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.2s;
    box-sizing: border-box;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #667eea;
}

.form-group textarea {
    resize: vertical;
    min-height: 80px;
}

.checkbox-group {
    margin-bottom: 20px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.checkbox-group input[type="checkbox"] {
    width: auto;
    margin: 0;
    flex-shrink: 0;
}

.checkbox-group label {
    margin: 0;
    font-weight: 400;
    color: #666;
    line-height: 1.5;
}

.btn {
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

.btn-primary {
    background: #667eea;
    color: white;
}

.btn-primary:hover {
    background: #5a6fd8;
}

.btn-full {
    width: 100%;
    justify-content: center;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const classNameSelect = document.getElementById('class_id');
    const packageGroup = document.getElementById('packageGroup');
    const packageSelect = document.getElementById('package_months');
    const priceDisplay = document.getElementById('priceDisplay');
    const originalPriceSpan = document.getElementById('originalPrice');
    const discountAmountSpan = document.getElementById('discountAmount');
    const finalPriceSpan = document.getElementById('finalPrice');

    // Discount rates for each package
    const discountRates = {
        1: 0,    // 1 month: 0% discount
        3: 5,    // 3 months: 5% discount
        6: 10,   // 6 months: 10% discount
        12: 15   // 12 months: 15% discount
    };

    function calculatePrice() {
        const selectedOption = classNameSelect.options[classNameSelect.selectedIndex];
        const packageMonths = parseInt(packageSelect.value);
        
        if (!selectedOption.value || !packageMonths) {
            priceDisplay.style.display = 'none';
            return;
        }

        const monthlyPrice = parseFloat(selectedOption.dataset.price);
        const totalMonths = packageMonths;
        const totalPrice = monthlyPrice * totalMonths; // Tổng giá cho tất cả tháng
        const discountRate = discountRates[packageMonths] || 0;
        const discountAmount = (totalPrice * discountRate) / 100;
        const finalPrice = totalPrice - discountAmount;

        // Update display
        originalPriceSpan.textContent = formatPrice(totalPrice);
        discountAmountSpan.textContent = formatPrice(discountAmount);
        finalPriceSpan.textContent = formatPrice(finalPrice);
        
        priceDisplay.style.display = 'block';
    }

    function formatPrice(price) {
        return new Intl.NumberFormat('vi-VN').format(Math.round(price)) + '₫';
    }

    // Show package selection when class is selected
    classNameSelect.addEventListener('change', function() {
        if (this.value) {
            packageGroup.style.display = 'block';
            packageSelect.required = true;
        } else {
            packageGroup.style.display = 'none';
            priceDisplay.style.display = 'none';
            packageSelect.required = false;
            packageSelect.value = '';
        }
        calculatePrice();
    });

    // Calculate price when package changes
    packageSelect.addEventListener('change', calculatePrice);

    // Initialize on page load
    if (classNameSelect.value) {
        packageGroup.style.display = 'block';
        packageSelect.required = true;
        calculatePrice();
    }

    // Auto-focus on name field
    document.getElementById('fullname').focus();
});
</script>
@endpush
@endsection
