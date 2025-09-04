<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Yoga/Gym Center</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>
    <%@ include file="../components/header.jspf" %>
    <script>
    function toggleMainNav() {
        var navList = document.querySelector('.main-nav .nav-list');
        navList.style.display = (navList.style.display === 'flex' || navList.style.display === '') ? 'block' : 'flex';
    }
    function handleMainNavResize() {
        var navToggle = document.querySelector('.main-nav .nav-toggle');
        var navList = document.querySelector('.main-nav .nav-list');
        if(window.innerWidth <= 768) {
            navToggle.style.display = 'block';
            navList.style.display = 'none';
        } else {
            navToggle.style.display = 'none';
            navList.style.display = 'flex';
        }
    }
    window.addEventListener('resize', handleMainNavResize);
    document.addEventListener('DOMContentLoaded', handleMainNavResize);
    </script>
    <style>
    .main-nav .container {
        padding: 0 10px;
        position: relative;
    }
    .main-nav .nav-list {
        transition: all 0.3s;
    }
    @media (max-width: 768px) {
        .main-nav .nav-list {
            flex-direction: column;
            gap: 0;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-radius: 10px;
            position: absolute;
            top: 55px;
            left: 10px;
            right: 10px;
            z-index: 100;
            padding: 10px 0;
        }
        .main-nav .nav-list li {
            margin: 10px 0;
        }
        .main-nav .nav-toggle {
            display: block !important;
        }
    }
    </style>

    <main>
        <div class="container">
            <section class="hero">
                <h2>Chào mừng đến với Yoga/Gym Center</h2>
                <p>Khám phá hành trình tìm lại sự cân bằng và khỏe mạnh cho cơ thể và tâm hồn</p>
                <a href="register.jsp" class="btn btn-primary">Đăng ký ngay</a>
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
                <h2 style="text-align: center; color: #667eea; margin-bottom: 30px;">Tại sao chọn chúng tôi?
                </h2>
                <div
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                    <div style="text-align: center;">
                        <h4>🏆 Kinh nghiệm 10+ năm</h4>
                        <p>Hơn 10 năm hoạt động và phát triển trong lĩnh vực Yoga/Gym</p>
                    </div>
                    <div style="text-align: center;">
                        <h4>👥 Cộng đồng 1000+ thành viên</h4>
                        <p>Gia nhập cộng đồng những người yêu thích sức khỏe và thể thao</p>
                    </div>
                    <div style="text-align: center;">
                        <h4>💰 Giá cả hợp lý</h4>
                        <p>Các gói tập đa dạng với mức giá phù hợp mọi đối tượng</p>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <%@ include file="../components/footer.jspf" %>
</body>
</html>