<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách lớp - Yoga/Gym Center</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/classes.css">
    <script src="../assets/js/members.js"></script>
</head>
<body>
    <%@ include file="../components/header.jspf" %>
    
    <main>
        <div class="container">
            <h1 class="page-title">📋 Danh sách lớp học</h1>
            <p style="text-align: center; color: rgba(255,255,255,0.9); font-size: 1.1rem; margin-bottom: 40px;">
                Nhấn vào từng lớp để xem danh sách học viên đang tham gia
            </p>

            <div class="class-list-container">
                <!-- Yoga Sáng -->
                <div class="class-item" onclick="toggleMembers(this)">
                    <div class="class-header">
                        <div class="class-icon">🌅</div>
                        <h3 class="class-name">Yoga Sáng</h3>
                    </div>
                    
                    <div class="class-schedule">
                        <p><strong>⏰ Thời gian:</strong> 6:00 - 7:00 (Thứ 2, 4, 6)</p>
                        <p><strong>👨‍🏫 Giảng viên:</strong> Cô Minh Anh</p>
                        <p><strong>📍 Phòng:</strong> Studio A</p>
                    </div>
                    
                    <div class="class-stats">
                        <div class="stat-item">
                            <div class="stat-number">15</div>
                            <div class="stat-label">Học viên</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">20</div>
                            <div class="stat-label">Sức chứa</div>
                        </div>
                    </div>
                    
                    <button class="toggle-members-btn">👥 Xem danh sách học viên</button>
                    
                    <div class="members-list">
                        <h4 style="color: #667eea; margin: 20px 0 15px 0;">Danh sách học viên:</h4>
                        <div class="member-item">
                            <div class="member-avatar">👩</div>
                            <div class="member-info">
                                <h5>Nguyễn Thị Lan</h5>
                                <p>📧 lan.nguyen@email.com | 📱 0901234567</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👨</div>
                            <div class="member-info">
                                <h5>Trần Văn Minh</h5>
                                <p>📧 minh.tran@email.com | 📱 0912345678</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👩</div>
                            <div class="member-info">
                                <h5>Lê Thị Hoa</h5>
                                <p>📧 hoa.le@email.com | 📱 0923456789</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👨</div>
                            <div class="member-info">
                                <h5>Phạm Văn Đức</h5>
                                <p>📧 duc.pham@email.com | 📱 0934567890</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👩</div>
                            <div class="member-info">
                                <h5>Hoàng Thị Mai</h5>
                                <p>📧 mai.hoang@email.com | 📱 0945678901</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Yoga Tối -->
                <div class="class-item" onclick="toggleMembers(this)">
                    <div class="class-header">
                        <div class="class-icon">🌙</div>
                        <h3 class="class-name">Yoga Tối</h3>
                    </div>
                    
                    <div class="class-schedule">
                        <p><strong>⏰ Thời gian:</strong> 18:00 - 19:00 (Thứ 3, 5, 7)</p>
                        <p><strong>👨‍🏫 Giảng viên:</strong> Thầy Quang Huy</p>
                        <p><strong>📍 Phòng:</strong> Studio B</p>
                    </div>
                    
                    <div class="class-stats">
                        <div class="stat-item">
                            <div class="stat-number">18</div>
                            <div class="stat-label">Học viên</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">20</div>
                            <div class="stat-label">Sức chứa</div>
                        </div>
                    </div>
                    
                    <button class="toggle-members-btn">👥 Xem danh sách học viên</button>
                    
                    <div class="members-list">
                        <h4 style="color: #667eea; margin: 20px 0 15px 0;">Danh sách học viên:</h4>
                        <div class="member-item">
                            <div class="member-avatar">👨</div>
                            <div class="member-info">
                                <h5>Vũ Văn Nam</h5>
                                <p>📧 nam.vu@email.com | 📱 0956789012</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👩</div>
                            <div class="member-info">
                                <h5>Đặng Thị Linh</h5>
                                <p>📧 linh.dang@email.com | 📱 0967890123</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👨</div>
                            <div class="member-info">
                                <h5>Bùi Văn Tuấn</h5>
                                <p>📧 tuan.bui@email.com | 📱 0978901234</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👩</div>
                            <div class="member-info">
                                <h5>Tôn Thị Nga</h5>
                                <p>📧 nga.ton@email.com | 📱 0989012345</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gym -->
                <div class="class-item" onclick="toggleMembers(this)">
                    <div class="class-header">
                        <div class="class-icon">💪</div>
                        <h3 class="class-name">Gym</h3>
                    </div>
                    
                    <div class="class-schedule">
                        <p><strong>⏰ Thời gian:</strong> 7:00 - 21:00 (Hàng ngày)</p>
                        <p><strong>👨‍🏫 Hỗ trợ:</strong> Team PT chuyên nghiệp</p>
                        <p><strong>📍 Khu vực:</strong> Tầng 2 - Gym Zone</p>
                    </div>
                    
                    <div class="class-stats">
                        <div class="stat-item">
                            <div class="stat-number">45</div>
                            <div class="stat-label">Thành viên</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">∞</div>
                            <div class="stat-label">Không giới hạn</div>
                        </div>
                    </div>
                    
                    <button class="toggle-members-btn">👥 Xem danh sách thành viên</button>
                    
                    <div class="members-list">
                        <h4 style="color: #667eea; margin: 20px 0 15px 0;">Danh sách thành viên Gym:</h4>
                        <div class="member-item">
                            <div class="member-avatar">👨</div>
                            <div class="member-info">
                                <h5>Ngô Văn Khang</h5>
                                <p>📧 khang.ngo@email.com | 📱 0990123456</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👩</div>
                            <div class="member-info">
                                <h5>Lý Thị Oanh</h5>
                                <p>📧 oanh.ly@email.com | 📱 0901234567</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👨</div>
                            <div class="member-info">
                                <h5>Cao Văn Thành</h5>
                                <p>📧 thanh.cao@email.com | 📱 0912345678</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👩</div>
                            <div class="member-info">
                                <h5>Đinh Thị Phương</h5>
                                <p>📧 phuong.dinh@email.com | 📱 0923456789</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👨</div>
                            <div class="member-info">
                                <h5>Hồ Văn Long</h5>
                                <p>📧 long.ho@email.com | 📱 0934567890</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👩</div>
                            <div class="member-info">
                                <h5>Trịnh Thị Xuân</h5>
                                <p>📧 xuan.trinh@email.com | 📱 0945678901</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Yoga Cơ bản -->
                <div class="class-item" onclick="toggleMembers(this)">
                    <div class="class-header">
                        <div class="class-icon">🧘‍♀️</div>
                        <h3 class="class-name">Yoga Cơ bản</h3>
                    </div>
                    
                    <div class="class-schedule">
                        <p><strong>⏰ Thời gian:</strong> 9:00 - 10:00 (Thứ 2, 4, 6)</p>
                        <p><strong>👨‍🏫 Giảng viên:</strong> Cô Thảo Nguyên</p>
                        <p><strong>📍 Phòng:</strong> Studio C</p>
                    </div>
                    
                    <div class="class-stats">
                        <div class="stat-item">
                            <div class="stat-number">10</div>
                            <div class="stat-label">Học viên</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">15</div>
                            <div class="stat-label">Sức chứa</div>
                        </div>
                    </div>
                    
                    <button class="toggle-members-btn">👥 Xem danh sách học viên</button>
                    
                    <div class="members-list">
                        <h4 style="color: #667eea; margin: 20px 0 15px 0;">Danh sách học viên:</h4>
                        <div class="member-item">
                            <div class="member-avatar">👩</div>
                            <div class="member-info">
                                <h5>Phan Thị Kim</h5>
                                <p>📧 kim.phan@email.com | 📱 0956789012</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👨</div>
                            <div class="member-info">
                                <h5>Lâm Văn Tài</h5>
                                <p>📧 tai.lam@email.com | 📱 0967890123</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👩</div>
                            <div class="member-info">
                                <h5>Võ Thị Hằng</h5>
                                <p>📧 hang.vo@email.com | 📱 0978901234</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Yoga Nâng cao -->
                <div class="class-item" onclick="toggleMembers(this)">
                    <div class="class-header">
                        <div class="class-icon">🧘‍♂️</div>
                        <h3 class="class-name">Yoga Nâng cao</h3>
                    </div>
                    
                    <div class="class-schedule">
                        <p><strong>⏰ Thời gian:</strong> 19:00 - 20:30 (Thứ 3, 5, 7)</p>
                        <p><strong>👨‍🏫 Giảng viên:</strong> Thầy Minh Đức</p>
                        <p><strong>📍 Phòng:</strong> Studio A</p>
                    </div>
                    
                    <div class="class-stats">
                        <div class="stat-item">
                            <div class="stat-number">8</div>
                            <div class="stat-label">Học viên</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">12</div>
                            <div class="stat-label">Sức chứa</div>
                        </div>
                    </div>
                    
                    <button class="toggle-members-btn">👥 Xem danh sách học viên</button>
                    
                    <div class="members-list">
                        <h4 style="color: #667eea; margin: 20px 0 15px 0;">Danh sách học viên:</h4>
                        <div class="member-item">
                            <div class="member-avatar">👨</div>
                            <div class="member-info">
                                <h5>Dương Văn Hùng</h5>
                                <p>📧 hung.duong@email.com | 📱 0989012345</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👩</div>
                            <div class="member-info">
                                <h5>Châu Thị Lam</h5>
                                <p>📧 lam.chau@email.com | 📱 0990123456</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👨</div>
                            <div class="member-info">
                                <h5>Kiều Văn Sơn</h5>
                                <p>📧 son.kieu@email.com | 📱 0901234567</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Yoga Flow -->
                <div class="class-item" onclick="toggleMembers(this)">
                    <div class="class-header">
                        <div class="class-icon">🤸‍♀️</div>
                        <h3 class="class-name">Yoga Flow</h3>
                    </div>
                    
                    <div class="class-schedule">
                        <p><strong>⏰ Thời gian:</strong> 17:00 - 18:00 (Thứ 2, 4, 6)</p>
                        <p><strong>👨‍🏫 Giảng viên:</strong> Cô Phương Linh</p>
                        <p><strong>📍 Phòng:</strong> Studio B</p>
                    </div>
                    
                    <div class="class-stats">
                        <div class="stat-item">
                            <div class="stat-number">12</div>
                            <div class="stat-label">Học viên</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">18</div>
                            <div class="stat-label">Sức chứa</div>
                        </div>
                    </div>
                    
                    <button class="toggle-members-btn">👥 Xem danh sách học viên</button>
                    
                    <div class="members-list">
                        <h4 style="color: #667eea; margin: 20px 0 15px 0;">Danh sách học viên:</h4>
                        <div class="member-item">
                            <div class="member-avatar">👩</div>
                            <div class="member-info">
                                <h5>Mai Thị Hồng</h5>
                                <p>📧 hong.mai@email.com | 📱 0912345678</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👨</div>
                            <div class="member-info">
                                <h5>Lưu Văn Thắng</h5>
                                <p>📧 thang.luu@email.com | 📱 0923456789</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👩</div>
                            <div class="member-info">
                                <h5>Từ Thị Yến</h5>
                                <p>📧 yen.tu@email.com | 📱 0934567890</p>
                            </div>
                        </div>
                        <div class="member-item">
                            <div class="member-avatar">👨</div>
                            <div class="member-info">
                                <h5>Ông Văn Đạt</h5>
                                <p>📧 dat.ong@email.com | 📱 0945678901</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <%@ include file="../components/footer.jspf" %>
</body>
</html>
