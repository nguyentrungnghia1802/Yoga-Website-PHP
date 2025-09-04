<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký lớp học - Yoga/Gym Center</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/register.js"></script>
</head>
<body>
    <%@ include file="../components/header.jspf" %>
    
    <main>
        <div class="container">
            <h1 class="page-title">📝 Đăng ký lớp học</h1>
            
            <%@ include file="../components/alert.jspf" %>
            
            <div class="form-container">
                <div class="card">
                    <h2 style="text-align: center; color: #667eea; margin-bottom: 30px;">Thông tin đăng ký</h2>
                    
                    <form id="registerForm" action="#" method="post" onsubmit="return handleSubmit(event)">
                        <div class="form-group">
                            <label for="fullname">👤 Họ và tên *</label>
                            <input type="text" id="fullname" name="fullname" required 
                                   placeholder="Nhập họ và tên đầy đủ">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">📧 Email *</label>
                            <input type="email" id="email" name="email" required 
                                   placeholder="example@email.com">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">📱 Số điện thoại *</label>
                            <input type="tel" id="phone" name="phone" required 
                                   placeholder="0909123456">
                        </div>
                        
                        <div class="form-group">
                            <label for="className">🏃‍♀️ Chọn lớp học *</label>
                            <select id="className" name="className" required>
                                <option value="">-- Chọn lớp học --</option>
                                <option value="Yoga Sáng">🌅 Yoga Sáng (6:00 - 7:00)</option>
                                <option value="Yoga Tối">🌙 Yoga Tối (18:00 - 19:00)</option>
                                <option value="Gym">💪 Gym (7:00 - 21:00)</option>
                                <option value="Yoga Cơ bản">🧘‍♀️ Yoga Cơ bản (9:00 - 10:00)</option>
                                <option value="Yoga Nâng cao">🧘‍♂️ Yoga Nâng cao (19:00 - 20:30)</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="package">💳 Gói tập *</label>
                            <select id="package" name="package" required>
                                <option value="">-- Chọn gói tập --</option>
                                <option value="1 tháng">1 tháng - 500.000đ</option>
                                <option value="3 tháng">3 tháng - 1.400.000đ (Tiết kiệm 100k)</option>
                                <option value="6 tháng">6 tháng - 2.700.000đ (Tiết kiệm 300k)</option>
                                <option value="12 tháng">12 tháng - 5.000.000đ (Tiết kiệm 1.000k)</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="note">📝 Ghi chú (tùy chọn)</label>
                            <textarea id="note" name="note" rows="3" 
                                      placeholder="Thông tin bổ sung, yêu cầu đặc biệt..."></textarea>
                        </div>
                        
                        <div style="text-align: center; margin-top: 30px;">
                            <button type="submit" class="btn btn-primary">✅ Đăng ký ngay</button>
                            <a href="classes.jsp" class="btn" style="margin-left: 15px;">👀 Xem lớp học</a>
                        </div>
                    </form>
                </div>
                
                <div class="card" style="margin-top: 30px;">
                    <h3 style="color: #667eea; margin-bottom: 20px;">📋 Quy định đăng ký</h3>
                    <ul style="line-height: 2;">
                        <li>✅ Học viên cần đến sớm 15 phút trước giờ học</li>
                        <li>✅ Mang theo khăn tập và nước uống</li>
                        <li>✅ Thông báo trước 24h nếu không thể tham gia</li>
                        <li>✅ Tuân thủ quy định của trung tâm</li>
                        <li>✅ Có thể thay đổi lịch học với phí 50.000đ</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    
    <%@ include file="../components/footer.jspf" %>

    <script>
        function handleSubmit(event) {
            event.preventDefault();
            
            // Validate form
            const fullname = document.getElementById('fullname').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const className = document.getElementById('className').value;
            const package = document.getElementById('package').value;
            
            if (!fullname || !email || !phone || !className || !package) {
                alert('Vui lòng điền đầy đủ thông tin bắt buộc!');
                return false;
            }
            
            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Email không đúng định dạng!');
                return false;
            }
            
            // Validate phone
            const phoneRegex = /^[0-9]{10,11}$/;
            if (!phoneRegex.test(phone)) {
                alert('Số điện thoại không đúng định dạng!');
                return false;
            }
            
            // Show success message
            alert('🎉 Đăng ký thành công!\n\n' +
                  'Thông tin đăng ký:\n' +
                  '👤 Họ tên: ' + fullname + '\n' +
                  '📧 Email: ' + email + '\n' +
                  '📱 SĐT: ' + phone + '\n' +
                  '🏃‍♀️ Lớp: ' + className + '\n' +
                  '💳 Gói: ' + package + '\n\n' +
                  'Chúng tôi sẽ liên hệ với bạn trong 24h để xác nhận!');
            
            // Reset form
            document.getElementById('registerForm').reset();
            
            return false;
        }
        
        function validateForm() {
            return handleSubmit(event);
        }
    </script>
</body>
</html>
