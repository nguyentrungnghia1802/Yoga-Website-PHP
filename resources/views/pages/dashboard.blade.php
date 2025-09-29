@extends('layouts.app')

@section('title', 'User Dashboard - Yoga/Gym Center')

@section('content')
<section class="hero">
    <h2>Chào mừng đến với Yoga/Gym Center</h2>
    <p>Khám phá hành trình tìm lại sự cân bằng và khỏe mạnh cho cơ thể và tâm hồn</p>
    <a href="{{ route('register') }}" class="btn btn-primary">Đăng ký ngay</a>
</section>

<section class="features">
    <div class="feature">
        <h3>🧘‍♀️ Yoga Chuyên nghiệp</h3>
        <p>Các lớp Yoga từ cơ bản đến nâng cao với giảng viên có chứng chỉ quốc tế</p>
    </div>
    <div class="feature">
        <h3>💪 Phòng tập Gym hiện đại</h3>
        <p>Trang thiết bị tập luyện hiện đại, đa dạng phục vụ mọi nhu cầu tập luyện</p>
    </div>
    <div class="feature">
        <h3>⏰ Lịch học linh hoạt</h3>
        <p>Đa dạng khung giờ từ sáng sớm đến tối muộn, phù hợp mọi lịch trình</p>
    </div>
    <div class="feature">
        <h3>👨‍⚕️ Hỗ trợ chuyên môn</h3>
        <p>Đội ngũ huấn luyện viên chuyên nghiệp, tận tâm hỗ trợ học viên</p>
    </div>
</section>

<section class="card">
    <h2 style="text-align: center; color: #667eea; margin-bottom: 30px;">Tại sao chọn chúng tôi?</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px;">
        <div style="text-align: center; min-height: 120px; display: flex; flex-direction: column; justify-content: center; padding: 20px; background: rgba(102, 126, 234, 0.05); border-radius: 12px;">
            <h4 style="color: #667eea; margin-bottom: 12px; font-size: 1.2rem;">🏆 Kinh nghiệm 10+ năm</h4>
            <p style="color: #666; line-height: 1.3; font-size: 0.95rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Hơn 10 năm hoạt động và phát triển trong lĩnh vực Yoga/Gym</p>
        </div>
        <div style="text-align: center; min-height: 120px; display: flex; flex-direction: column; justify-content: center; padding: 20px; background: rgba(102, 126, 234, 0.05); border-radius: 12px;">
            <h4 style="color: #667eea; margin-bottom: 12px; font-size: 1.2rem;">👥 Cộng đồng 1000+ thành viên</h4>
            <p style="color: #666; line-height: 1.3; font-size: 0.95rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Gia nhập cộng đồng những người yêu thích sức khỏe và thể thao</p>
        </div>
        <div style="text-align: center; min-height: 120px; display: flex; flex-direction: column; justify-content: center; padding: 20px; background: rgba(102, 126, 234, 0.05); border-radius: 12px;">
            <h4 style="color: #667eea; margin-bottom: 12px; font-size: 1.2rem;">💰 Giá cả hợp lý</h4>
            <p style="color: #666; line-height: 1.3; font-size: 0.95rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Các gói tập đa dạng với mức giá phù hợp mọi đối tượng</p>
        </div>
    </div>
</section>
@endsection
