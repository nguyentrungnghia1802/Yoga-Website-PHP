<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách lớp học - Yoga/Gym Center</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/search.js"></script>
</head>
<body>
    <%@ include file="../components/header.jspf" %>
    
    <main>
        <div class="container">
            <h1 class="page-title">🏃‍♀️ Danh sách lớp học</h1>
            
            <div class="search-box">
                <input type="text" id="searchClass" placeholder="Tìm kiếm lớp học..." onkeyup="searchClassFunc()">
            </div>
            
            <div class="class-grid" id="classGrid">
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
                    <a href="register.jsp" class="btn btn-primary" style="margin-top: 15px; width: 100%;">Đăng ký ngay</a>
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
                    <a href="register.jsp" class="btn btn-primary" style="margin-top: 15px; width: 100%;">Đăng ký ngay</a>
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
                    <a href="register.jsp" class="btn btn-primary" style="margin-top: 15px; width: 100%;">Đăng ký ngay</a>
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
                    <a href="register.jsp" class="btn btn-primary" style="margin-top: 15px; width: 100%;">Đăng ký ngay</a>
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
                    <a href="register.jsp" class="btn btn-primary" style="margin-top: 15px; width: 100%;">Đăng ký ngay</a>
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
                    <a href="register.jsp" class="btn btn-primary" style="margin-top: 15px; width: 100%;">Đăng ký ngay</a>
                </div>
            </div>
            
            <div class="card" style="margin-top: 40px;">
                <h2 style="color: #667eea; text-align: center; margin-bottom: 30px;">📋 Bảng giá gói tập</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>🏃‍♀️ Loại lớp</th>
                                <th>⏰ Thời gian</th>
                                <th>💰 Giá 1 tháng</th>
                                <th>💰 Giá 3 tháng</th>
                                <th>💰 Giá 6 tháng</th>
                                <th>💰 Giá 12 tháng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Yoga Sáng</td>
                                <td>6:00 - 7:00</td>
                                <td>500.000đ</td>
                                <td>1.400.000đ</td>
                                <td>2.700.000đ</td>
                                <td>5.000.000đ</td>
                            </tr>
                            <tr>
                                <td>Yoga Tối</td>
                                <td>18:00 - 19:00</td>
                                <td>500.000đ</td>
                                <td>1.400.000đ</td>
                                <td>2.700.000đ</td>
                                <td>5.000.000đ</td>
                            </tr>
                            <tr>
                                <td>Gym</td>
                                <td>7:00 - 21:00</td>
                                <td>400.000đ</td>
                                <td>1.100.000đ</td>
                                <td>2.200.000đ</td>
                                <td>4.000.000đ</td>
                            </tr>
                            <tr>
                                <td>Yoga Cơ bản</td>
                                <td>9:00 - 10:00</td>
                                <td>450.000đ</td>
                                <td>1.250.000đ</td>
                                <td>2.400.000đ</td>
                                <td>4.500.000đ</td>
                            </tr>
                            <tr>
                                <td>Yoga Nâng cao</td>
                                <td>19:00 - 20:30</td>
                                <td>600.000đ</td>
                                <td>1.700.000đ</td>
                                <td>3.200.000đ</td>
                                <td>6.000.000đ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    
    <%@ include file="../components/footer.jspf" %>
</body>
</html>
