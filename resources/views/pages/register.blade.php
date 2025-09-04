@extends('layouts.app')

@section('title', 'Đăng ký lớp học - Yoga/Gym Center')

@push('scripts')
<script src="{{ asset('js/register.js') }}"></script>
@endpush

@section('content')
<h1 class="page-title">📝 Đăng ký lớp học</h1>

<div class="form-container">
    <div class="card">
        <h2 style="text-align: center; color: #667eea; margin-bottom: 30px;">Thông tin đăng ký</h2>
        
        <form id="registerForm" action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="fullname">👤 Họ và tên *</label>
                <input type="text" id="fullname" name="name" required 
                       placeholder="Nhập họ và tên đầy đủ" value="{{ old('name') }}">
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email">📧 Email *</label>
                <input type="email" id="email" name="email" required 
                       placeholder="example@email.com" value="{{ old('email') }}">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="phone">📱 Số điện thoại *</label>
                <input type="tel" id="phone" name="phone" required 
                       placeholder="0909123456" value="{{ old('phone') }}">
                @error('phone')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="className">🏃‍♀️ Chọn lớp học *</label>
                <select id="className" name="class_id" required>
                    <option value="">-- Chọn lớp học --</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }} ({{ \Carbon\Carbon::parse($class->date_time)->format('H:i') }})
                        </option>
                    @endforeach
                    
                    @if($classes->isEmpty())
                    <option value="yoga-sang">🌅 Yoga Sáng (6:00 - 7:00)</option>
                    <option value="yoga-toi">🌙 Yoga Tối (18:00 - 19:00)</option>
                    <option value="gym">💪 Gym (7:00 - 21:00)</option>
                    <option value="yoga-co-ban">🧘‍♀️ Yoga Cơ bản (9:00 - 10:00)</option>
                    <option value="yoga-nang-cao">🧘‍♂️ Yoga Nâng cao (19:00 - 20:30)</option>
                    <option value="yoga-flow">🤸‍♀️ Yoga Flow (17:00 - 18:00)</option>
                    @endif
                </select>
                @error('class_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="startDate">📅 Ngày bắt đầu *</label>
                <input type="date" id="startDate" name="start_date" required value="{{ old('start_date') }}">
                @error('start_date')
                    <span class="error-message">{{ $message }}</span>
                @enderror
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
                <textarea id="notes" name="notes" rows="3" 
                         placeholder="Yêu cầu đặc biệt hoặc thông tin bổ sung...">{{ old('notes') }}</textarea>
            </div>
            
            <div class="checkbox-group">
                <input type="checkbox" id="terms" name="terms" required {{ old('terms') ? 'checked' : '' }}>
                <label for="terms">Tôi đồng ý với <a href="#" style="color: #667eea;">điều khoản sử dụng</a> và <a href="#" style="color: #667eea;">chính sách bảo mật</a> *</label>
                @error('terms')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="checkbox-group">
                <input type="checkbox" id="newsletter" name="newsletter" {{ old('newsletter') ? 'checked' : '' }}>
                <label for="newsletter">Nhận thông báo về các lớp học mới và ưu đãi</label>
            </div>
            
            <button type="submit" class="btn btn-primary btn-full">
                🎯 Đăng ký ngay
            </button>
        </form>
        
        <div style="text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
            <p style="color: #666;">Đã có tài khoản? <a href="{{ route('login') }}" style="color: #667eea; text-decoration: none;">Đăng nhập ngay</a></p>
        </div>
    </div>
</div>
@endsection
