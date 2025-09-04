<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ - Yoga/Gym Center</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
    <script src="../assets/js/contact.js"></script>
</head>
<body>
    <%@ include file="../components/header.jspf" %>
    
    <main>
        <div class="container">
            <h1 class="page-title">📞 Liên hệ với chúng tôi</h1>
            
            <div class="contact-container">
                <!-- Thông tin liên hệ -->
                <div class="contact-info">
                    <h2 style="color: #667eea; margin-bottom: 30px; text-align: center;">📍 Thông tin liên hệ</h2>
                    
                    <div class="contact-item">
                        <div class="contact-icon">🏢</div>
                        <div class="contact-details">
                            <h4>Địa chỉ</h4>
                            <p>123 Đường Láng<br>Phường Láng Thượng, Quận Đống Đa, Hà Nội</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">📱</div>
                        <div class="contact-details">
                            <h4>Hotline</h4>
                            <p>0909 123 456<br>024 3733 4455</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">📧</div>
                        <div class="contact-details">
                            <h4>Email</h4>
                            <p>info@yogagym.com<br>support@yogagym.com</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">🌐</div>
                        <div class="contact-details">
                            <h4>Website</h4>
                            <p>www.yogagym.com<br>www.yogagym.edu.vn</p>
                        </div>
                    </div>

                    <!-- Bảng giờ làm việc -->
                    <h3 style="color: #667eea; margin: 30px 0 20px; text-align: center;">⏰ Giờ làm việc</h3>
                    <table class="hours-table">
                        <thead>
                            <tr>
                                <th>Ngày</th>
                                <th>Giờ mở cửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Thứ 2 - Thứ 6</strong></td>
                                <td>5:30 - 22:00</td>
                            </tr>
                            <tr>
                                <td><strong>Thứ 7</strong></td>
                                <td>6:00 - 21:00</td>
                            </tr>
                            <tr>
                                <td><strong>Chủ nhật</strong></td>
                                <td>7:00 - 20:00</td>
                            </tr>
                            <tr style="background: #fff5f5;">
                                <td><strong>Ngày lễ</strong></td>
                                <td>8:00 - 18:00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Form liên hệ -->
                <div class="contact-form">
                    <h2 style="color: #667eea; margin-bottom: 30px; text-align: center;">✉️ Gửi tin nhắn</h2>
                    
                    <form id="contactForm" onsubmit="return handleContactSubmit(event)">
                        <div class="form-group">
                            <label for="contactName">👤 Họ và tên *</label>
                            <input type="text" id="contactName" name="contactName" required 
                                   placeholder="Nhập họ và tên của bạn">
                        </div>
                        
                        <div class="form-group">
                            <label for="contactEmail">📧 Email *</label>
                            <input type="email" id="contactEmail" name="contactEmail" required 
                                   placeholder="example@email.com">
                        </div>
                        
                        <div class="form-group">
                            <label for="contactPhone">📱 Số điện thoại</label>
                            <input type="tel" id="contactPhone" name="contactPhone" 
                                   placeholder="0909 123 456">
                        </div>
                        
                        <div class="form-group">
                            <label for="contactSubject">📋 Chủ đề *</label>
                            <select id="contactSubject" name="contactSubject" required>
                                <option value="">-- Chọn chủ đề --</option>
                                <option value="register">🏃‍♀️ Đăng ký lớp học</option>
                                <option value="price">💰 Hỏi giá dịch vụ</option>
                                <option value="schedule">📅 Lịch tập</option>
                                <option value="facility">🏢 Cơ sở vật chất</option>
                                <option value="feedback">💬 Góp ý</option>
                                <option value="complaint">❗ Khiếu nại</option>
                                <option value="other">❓ Khác</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="contactMessage">💬 Nội dung *</label>
                            <textarea id="contactMessage" name="contactMessage" rows="5" required
                                      placeholder="Nhập nội dung tin nhắn của bạn..."></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">
                            🚀 Gửi tin nhắn
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Bản đồ -->
            <div class="map-container">
                <h3 style="color: #667eea; margin-bottom: 20px;">🗺️ Vị trí trên bản đồ</h3>
                <div style="text-align: center; color: #666;">
                    <div style="font-size: 4rem; margin-bottom: 20px;">🏢</div>
                    <p><strong>Yoga/Gym Center</strong></p>
                    <p>123 Đường Láng, Phường Láng Thượng, Quận Đống Đa, Hà Nội</p>
                    <p style="margin-top: 20px; color: #667eea;">
                        <em>🚇 Gần ga Metro Cát Linh - 🚌 Nhiều tuyến xe buýt - 🅿️ Có bãi đỗ xe</em>
                    </p>
                </div>
            </div>
            
            <!-- Mạng xã hội -->
            <div class="social-section">
                <h2 style="color: #667eea; margin-bottom: 20px;">🌟 Kết nối với chúng tôi</h2>
                <p style="color: #666; margin-bottom: 30px;">
                    Theo dõi chúng tôi trên các nền tảng mạng xã hội để cập nhật những thông tin mới nhất về các lớp học, khuyến mãi và sự kiện đặc biệt!
                </p>
                
                <div class="social-links">
                    <a href="#" class="social-link" title="Facebook">📘</a>
                    <a href="#" class="social-link" title="Instagram">📷</a>
                    <a href="#" class="social-link" title="YouTube">📺</a>
                    <a href="#" class="social-link" title="TikTok">🎵</a>
                    <a href="#" class="social-link" title="Zalo">💬</a>
                    <a href="#" class="social-link" title="Telegram">✈️</a>
                </div>
                
                <div style="margin-top: 30px; padding: 20px; background: rgba(102, 126, 234, 0.05); border-radius: 15px;">
                    <h4 style="color: #667eea; margin-bottom: 15px;">🎁 Ưu đãi đặc biệt</h4>
                    <p style="color: #555; margin: 0;">
                        <strong>Giảm 20%</strong> cho khách hàng đầu tiên đăng ký qua website! 
                        <br>Sử dụng mã: <strong style="color: #667eea;">WELCOME2025</strong>
                    </p>
                </div>
            </div>
        </div>
    </main>
    
    <%@ include file="../components/footer.jspf" %>
</body>
</html>
