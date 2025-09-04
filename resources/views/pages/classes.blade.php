@extends('layouts.app')

@section('title', 'Danh sách lớp học - Yoga/Gym Center')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/classes.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/search.js') }}"></script>
@endpush

@section('content')
<h1 class="page-title">🏃‍♀️ Danh sách lớp học</h1>

<div class="search-box">
    <input type="text" id="searchClass" placeholder="Tìm kiếm lớp học..." onkeyup="searchClassFunc()">
</div>

<div class="class-grid" id="classGrid">
    @foreach($classes as $class)
    <div class="class-card">
        <h3>{{ $class->name }}</h3>
        <p>{{ $class->description }}</p>
        <span class="time">⏰ {{ \Carbon\Carbon::parse($class->date_time)->format('H:i') }}</span>
        <div class="price">💰 {{ number_format($class->price ?? 500000) }}đ/tháng</div>
        <div style="margin-top: 15px;">
            <span style="background: #51cf66; color: white; padding: 4px 8px; border-radius: 15px; font-size: 12px;">
                👥 {{ $class->teacher->name ?? 'Chưa có giảng viên' }}
            </span>
        </div>
        <a href="{{ route('register') }}" class="btn btn-primary" style="margin-top: 15px; width: 100%;">Đăng ký ngay</a>
    </div>
    @endforeach
    
    @if($classes->isEmpty())
    <!-- Static classes when no database classes -->
    <div class="class-card">
        <h3>🌅 Yoga Sáng</h3>
        <p>Bắt đầu ngày mới với năng lượng tích cực qua các bài tập yoga nhẹ nhàng</p>
        <span class="time">⏰ 6:00 - 7:00</span>
        <div class="price">💰 500.000đ/tháng</div>
        <div style="margin-top: 15px;">
            <span style="background: #51cf66; color: white; padding: 4px 8px; border-radius: 15px; font-size: 12px;">
                👥 15/20 học viên
            </span>
        </div>
        <a href="{{ route('register') }}" class="btn btn-primary" style="margin-top: 15px; width: 100%;">Đăng ký ngay</a>
    </div>
    
    <div class="class-card">
        <h3>🌙 Yoga Tối</h3>
        <p>Thư giãn sau ngày làm việc căng thẳng với yoga thư giãn sâu</p>
        <span class="time">⏰ 18:00 - 19:00</span>
        <div class="price">💰 500.000đ/tháng</div>
        <div style="margin-top: 15px;">
            <span style="background: #ff6b6b; color: white; padding: 4px 8px; border-radius: 15px; font-size: 12px;">
                👥 18/20 học viên
            </span>
        </div>
        <a href="{{ route('register') }}" class="btn btn-primary" style="margin-top: 15px; width: 100%;">Đăng ký ngay</a>
    </div>
    
    <div class="class-card">
        <h3>💪 Gym</h3>
        <p>Tập luyện sức mạnh và thể lực với đầy đủ thiết bị hiện đại</p>
        <span class="time">⏰ 7:00 - 21:00</span>
        <div class="price">💰 400.000đ/tháng</div>
        <div style="margin-top: 15px;">
            <span style="background: #667eea; color: white; padding: 4px 8px; border-radius: 15px; font-size: 12px;">
                👥 Không giới hạn
            </span>
        </div>
        <a href="{{ route('register') }}" class="btn btn-primary" style="margin-top: 15px; width: 100%;">Đăng ký ngay</a>
    </div>
    
    <div class="class-card">
        <h3>🧘‍♀️ Yoga Cơ bản</h3>
        <p>Dành cho người mới bắt đầu, học các tư thế yoga cơ bản</p>
        <span class="time">⏰ 9:00 - 10:00</span>
        <div class="price">💰 450.000đ/tháng</div>
        <div style="margin-top: 15px;">
            <span style="background: #51cf66; color: white; padding: 4px 8px; border-radius: 15px; font-size: 12px;">
                👥 10/15 học viên
            </span>
        </div>
        <a href="{{ route('register') }}" class="btn btn-primary" style="margin-top: 15px; width: 100%;">Đăng ký ngay</a>
    </div>
    
    <div class="class-card">
        <h3>🧘‍♂️ Yoga Nâng cao</h3>
        <p>Dành cho học viên có kinh nghiệm, thực hành các tư thế phức tạp</p>
        <span class="time">⏰ 19:00 - 20:30</span>
        <div class="price">💰 600.000đ/tháng</div>
        <div style="margin-top: 15px;">
            <span style="background: #ffc107; color: white; padding: 4px 8px; border-radius: 15px; font-size: 12px;">
                👥 8/12 học viên
            </span>
        </div>
        <a href="{{ route('register') }}" class="btn btn-primary" style="margin-top: 15px; width: 100%;">Đăng ký ngay</a>
    </div>
    
    <div class="class-card">
        <h3>🤸‍♀️ Yoga Flow</h3>
        <p>Kết hợp nhiều tư thế trong dòng chảy liền mạch, tăng sức bền</p>
        <span class="time">⏰ 17:00 - 18:00</span>
        <div class="price">💰 550.000đ/tháng</div>
        <div style="margin-top: 15px;">
            <span style="background: #51cf66; color: white; padding: 4px 8px; border-radius: 15px; font-size: 12px;">
                👥 12/18 học viên
            </span>
        </div>
        <a href="{{ route('register') }}" class="btn btn-primary" style="margin-top: 15px; width: 100%;">Đăng ký ngay</a>
    </div>
    @endif
</div>
@endsection
