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
                        <option value="{{ $class->id }}" data-price="{{ $class->price }}">
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
        <div id="registerResult" style="margin-top:20px;"></div>
        <div style="text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
            <p style="color: #666;">Đã có tài khoản? <a href="{{ route('admin.login') }}" style="color: #667eea; text-decoration: none;">Đăng nhập ngay (Admin)</a></p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('registerForm').onsubmit = async function(e) {
    e.preventDefault();
    const form = e.target;
    const resultDiv = document.getElementById('registerResult');
    resultDiv.innerHTML = '';
    const data = {
        customer: {
            name: form.name.value,
            email: form.email.value,
            phone: form.phone.value
        },
        class_id: form.class_id.value,
        note: form.notes.value,
        package_months: 1,
        start_date: form.start_date.value,
        experience: form.experience.value,
        terms: form.terms.checked,
        newsletter: form.newsletter.checked,
        idempotency_key: Date.now().toString() + Math.random().toString(36).slice(2)
    };
    try {
        const res = await fetch('/api/registrations', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });
        if (res.ok) {
            const json = await res.json();
            resultDiv.innerHTML = '<div class="alert alert-success">Đăng ký thành công! Mã đăng ký: ' + json.data.id + '</div>';
            form.reset();
        } else {
            const err = await res.json();
            resultDiv.innerHTML = '<div class="alert alert-error">' + (err.message || 'Đăng ký thất bại!') + '</div>';
        }
    } catch (error) {
        resultDiv.innerHTML = '<div class="alert alert-error">Lỗi hệ thống! Vui lòng thử lại sau.</div>';
    }
};
</script>
@endpush
