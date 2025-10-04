@extends('layouts.admin')

@section('title', 'Tạo đơn đăng ký mới')

@section('content')
<div class="page-header">
    <div class="header-navigation">
        <a href="{{ route('admin.registrations') }}" class="back-btn">
            ← Quay lại danh sách
        </a>
    </div>
    <div class="header-content">
        <h1>📝 Tạo đơn đăng ký mới</h1>
        <p>Tạo đơn đăng ký cho học viên (tự động duyệt)</p>
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
        <form id="registerForm" method="POST" action="{{ route('admin.registrations.create') }}" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="fullname">👤 Họ và tên *</label>
                <input type="text" id="fullname" name="name" required placeholder="Nhập họ và tên đầy đủ" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="email">📧 Email *</label>
                <input type="email" id="email" name="email" required placeholder="example@email.com" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="phone">📱 Số điện thoại *</label>
                <input type="tel" id="phone" name="phone" required placeholder="0909123456" value="{{ old('phone') }}">
            </div>
            <div class="form-group">
                <label for="class_id">🏃‍♀️ Chọn lớp học *</label>
                <select id="class_id" name="class_id" required>
                    <option value="">-- Chọn lớp học --</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" data-price="{{ $class->price }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }} - {{ $class->start_time }} - {{ $class->end_time }} ({{ number_format($class->price, 0, ',', '.') }}₫)
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="form-group">
                <label for="package_months">📦 Gói tháng *</label>
                <select id="package_months" name="package_months" required>
                    <option value="1" {{ old('package_months', 1) == 1 ? 'selected' : '' }}>1 tháng (Không giảm giá)</option>
                    <option value="3" {{ old('package_months') == 3 ? 'selected' : '' }}>3 tháng (Giảm 5%)</option>
                    <option value="6" {{ old('package_months') == 6 ? 'selected' : '' }}>6 tháng (Giảm 10%)</option>
                    <option value="12" {{ old('package_months') == 12 ? 'selected' : '' }}>12 tháng (Giảm 20%)</option>
                </select>
            </div> --}}
            <div class="form-group">
                <label for="start_date">📅 Ngày bắt đầu *</label>
                <input type="date" id="start_date" name="start_date" required value="{{ old('start_date') }}">
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
                <textarea id="notes" name="notes" rows="3" placeholder="Yêu cầu đặc biệt hoặc thông tin bổ sung...">{{ old('notes') }}</textarea>
            </div>
            
            <div class="price-display" id="priceDisplay" style="margin: 20px 0; padding: 15px; background: #f8f9fa; border-radius: 8px; display: none;">
                <h4>💰 Thông tin giá:</h4>
                <div id="priceDetails"></div>
            </div>
            
            <div class="checkbox-group">
                <label for="admin_confirm">✅ Tự động duyệt đơn đăng ký (Admin)</label>
            </div>
            
            <button type="submit" class="btn btn-primary btn-full">🎯 Tạo đơn đăng ký</button>
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

.price-display {
    border: 2px solid #28a745;
    background: #d4edda !important;
}

.price-display h4 {
    color: #155724;
    margin-bottom: 10px;
}

.price-display p {
    margin: 5px 0;
    color: #155724;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const classSelect = document.getElementById('class_id');
    const packageSelect = document.getElementById('package_months');
    const priceDisplay = document.getElementById('priceDisplay');
    const priceDetails = document.getElementById('priceDetails');

    function updatePrice() {
        const selectedClass = classSelect.options[classSelect.selectedIndex];
        const selectedPackage = packageSelect.value;
        
        if (selectedClass.value && selectedPackage) {
            const basePrice = parseFloat(selectedClass.dataset.price);
            const months = parseInt(selectedPackage);
            
            let discount = 0;
            switch(months) {
                case 3: discount = 5; break;
                case 6: discount = 10; break;
                case 12: discount = 20; break;
            }
            
            const totalPrice = basePrice * months;
            const discountAmount = totalPrice * (discount / 100);
            const finalPrice = totalPrice - discountAmount;
            
            priceDetails.innerHTML = `
                <p><strong>Lớp học:</strong> ${selectedClass.text}</p>
                <p><strong>Số tháng:</strong> ${months} tháng</p>
                <p><strong>Giá gốc:</strong> ${new Intl.NumberFormat('vi-VN').format(totalPrice)}₫</p>
                ${discount > 0 ? `<p><strong>Giảm giá:</strong> ${discount}% (-${new Intl.NumberFormat('vi-VN').format(discountAmount)}₫)</p>` : ''}
                <p style="font-size: 1.2rem; color: #28a745;"><strong>Thành tiền:</strong> ${new Intl.NumberFormat('vi-VN').format(finalPrice)}₫</p>
            `;
            priceDisplay.style.display = 'block';
        } else {
            priceDisplay.style.display = 'none';
        }
    }
    
    classSelect.addEventListener('change', updatePrice);
    packageSelect.addEventListener('change', updatePrice);
    
    // Update price on page load if values are already selected
    updatePrice();
    
    // Auto-focus on name field
    document.getElementById('fullname').focus();
});
</script>
@endpush
@endsection
