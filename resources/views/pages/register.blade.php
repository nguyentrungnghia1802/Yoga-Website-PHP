@extends('layouts.app')

@section('title', 'Đăng ký lớp học - Yoga/Gym Center')

@section('content')
<h1 class="page-title">📝 Đăng ký lớp học</h1>
<div class="form-container">
    <div class="card">
        <h2 style="text-align: center; color: #667eea; margin-bottom: 30px;">Thông tin đăng ký</h2>
        <form id="registerForm" method="POST" action="{{ route('register.submit') }}" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="fullname">👤 Họ và tên *</label>
                <input type="text" id="fullname" name="name" required placeholder="Nhập họ và tên đầy đủ">
            </div>
            <div class="form-group">
                <label for="email">📧 Email *</label>
                <input type="email" id="email" name="email" required placeholder="example@email.com">
            </div>
            <div class="form-group">
                <label for="phone">📱 Số điện thoại *</label>
                <input type="tel" id="phone" name="phone" required placeholder="0909123456">
            </div>
            <div class="form-group">
                <label for="className">🏃‍♀️ Chọn lớp học *</label>
            <select id="className" name="class_id" required>
                <option value="">-- Chọn lớp học --</option>
                @foreach($classes as $class)
                    @if(!$class->is_full)
                        <option value="{{ $class->id }}" data-price="{{ $class->price }}" 
                                {{ isset($selectedClassId) && $selectedClassId == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endif
                @endforeach
            </select>
            </div>
            
            <!-- Package Selection -->
            <div class="form-group" id="packageGroup" style="display: none;">
                <label for="package">📦 Chọn gói học *</label>
                <select id="package" name="package_months" required>
                    <option value="">-- Chọn gói học --</option>
                    <option value="1">1 tháng (0% giảm giá)</option>
                    <option value="3">3 tháng (5% giảm giá)</option>
                    <option value="6">6 tháng (10% giảm giá)</option>
                    <option value="12">12 tháng (15% giảm giá)</option>
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
                    <option value="beginner">🌱 Người mới bắt đầu</option>
                    <option value="intermediate">🌿 Trung bình</option>
                    <option value="advanced">🌳 Nâng cao</option>
                </select>
            </div>
            <div class="form-group">
                <label for="notes">📝 Ghi chú</label>
                <textarea id="notes" name="notes" rows="3" placeholder="Yêu cầu đặc biệt hoặc thông tin bổ sung..."></textarea>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">Tôi đồng ý với <a href="#" style="color: #667eea;">điều khoản sử dụng</a> và <a href="#" style="color: #667eea;">chính sách bảo mật</a> *</label>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="newsletter" name="newsletter">
                <label for="newsletter">Nhận thông báo về các lớp học mới và ưu đãi</label>
            </div>
            <button type="submit" class="btn btn-primary btn-full">🎯 Đăng ký ngay</button>
        </form>
        <div style="text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
            <!-- Đã có tài khoản? Đăng nhập ngay (Admin) removed for user registration form -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const classNameSelect = document.getElementById('className');
    const packageGroup = document.getElementById('packageGroup');
    const packageSelect = document.getElementById('package');
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

    // Hiển thị thông báo nếu có lớp học được chọn sẵn
    @if(isset($selectedClassId) && $selectedClassId)
        const selectedClass = document.querySelector('#className option[value="{{ $selectedClassId }}"]');
        if (selectedClass) {
            // Hiển thị thông báo nhỏ
            const alert = document.createElement('div');
            alert.className = 'alert alert-info';
            alert.style.cssText = 'background: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; padding: 10px; border-radius: 8px; margin-bottom: 15px;';
            alert.innerHTML = '✅ Đã chọn lớp học: <strong>' + selectedClass.textContent + '</strong>';
            
            const form = document.getElementById('registerForm');
            form.insertBefore(alert, form.firstChild);
            
            // Show package selection and calculate price
            packageGroup.style.display = 'block';
            packageSelect.required = true;
            calculatePrice();
            
            // Tự động focus vào trường tên
            document.getElementById('fullname').focus();
        }
    @endif
});
</script>
@endpush

@if(session('success'))
    <div class="alert alert-success" style="margin-top: 20px;">
        ✅ {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error" style="margin-top: 20px;">
        ❌ {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-error" style="margin-top: 20px;">
        ❌ Vui lòng kiểm tra lại thông tin:
        <ul style="margin: 10px 0 0 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
