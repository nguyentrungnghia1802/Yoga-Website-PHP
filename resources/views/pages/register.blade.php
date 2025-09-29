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
                        <option value="{{ $class->id }}" data-price="{{ $class->price }}" 
                                {{ isset($selectedClassId) && $selectedClassId == $class->id ? 'selected' : '' }}>
                            {{ $class->name }} - {{ $class->start_time }} - {{ $class->end_time }} ({{ number_format($class->price, 0, ',', '.') }}₫)
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="startDate">📅 Ngày bắt đầu *</label>
                <input type="date" id="startDate" name="start_date" required>
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
