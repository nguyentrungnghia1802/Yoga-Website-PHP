
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tác giả - Yoga/Gym Center</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/authors.css">
</head>
<body>
    <%@ include file="../components/header.jspf" %>
    <main>
        <div class="container">
            <div class="authors-intro">
                <h1>👥 Thành viên nhóm phát triển</h1>
                <p>Danh sách thành viên và nhiệm vụ chính của dự án Yoga/Gym Center.</p>
            </div>

            <!-- Leader riêng một hàng -->
            <div class="authors-row leader-row">
                <div class="author-card horizontal">
                    <div class="author-avatar">👩‍💼</div>
                    <div class="author-info-block">
                        <div class="author-name">Nguyễn Thị Cẩm Tú</div>
                        <div class="author-role">Trưởng nhóm - Frontend (User site)</div>
                        <div class="author-id">MSSV: K23DTCN549</div>
                        <div class="author-task">Develop UI for user site, integrate with API (listen for trigger)</div>
                    </div>
                </div>
            </div>

            <!-- 4 thành viên còn lại chia 2 hàng, mỗi hàng 2 người -->
            <div class="authors-row">
                <div class="author-card horizontal">
                    <div class="author-avatar">👨‍💻</div>
                    <div class="author-info-block">
                        <div class="author-name">Hoàng Trọng Lực</div>
                        <div class="author-role">Frontend (Admin site)</div>
                        <div class="author-id">MSSV: K23DTCN542</div>
                        <div class="author-task">Develop UI for admin site, integrate with API</div>
                    </div>
                </div>
                <div class="author-card horizontal">
                    <div class="author-avatar">👩‍💻</div>
                    <div class="author-info-block">
                        <div class="author-name">Nguyễn Thị Thu Hương</div>
                        <div class="author-role">Backend (User + Admin), DB Design</div>
                        <div class="author-id">MSSV: K23DTCN539</div>
                        <div class="author-task">Develop backend APIs for both admin and user site, design DB</div>
                    </div>
                </div>
            </div>
            <div class="authors-row">
                <div class="author-card horizontal">
                    <div class="author-avatar">👨‍💻</div>
                    <div class="author-info-block">
                        <div class="author-name">Vũ Huy Năng</div>
                        <div class="author-role">Frontend (User site)</div>
                        <div class="author-id">MSSV: K23DTCN543</div>
                        <div class="author-task">Develop UI for user site, integrate with API</div>
                    </div>
                </div>
                <div class="author-card horizontal">
                    <div class="author-avatar">👨‍💻</div>
                    <div class="author-info-block">
                        <div class="author-name">Nguyễn Trung Hiếu</div>
                        <div class="author-role">Frontend (Admin site)</div>
                        <div class="author-id">MSSV: K23DTCN536</div>
                        <div class="author-task">Develop UI for admin site, integrate with API</div>
                    </div>
                </div>
            </div>

            <!-- Thông tin về dự án -->
            <div class="project-info">
                <h2>🎯 Về dự án Yoga/Gym Center</h2>
                <div class="project-stats">
                    <div class="stat-item">
                        <div class="stat-number">8</div>
                        <div class="stat-label">Tuần phát triển</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Tính năng</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">File code</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">1000+</div>
                        <div class="stat-label">Dòng code</div>
                    </div>
                </div>
                <div class="project-details">
                    <div class="project-detail-item">
                        <h3>🚀 Mục tiêu dự án</h3>
                        <p>Phát triển một hệ thống quản lý trung tâm Yoga/Gym toàn diện, hỗ trợ đăng ký lớp học, quản lý thành viên, và các tính năng quản trị cho nhân viên. Hệ thống được thiết kế với giao diện thân thiện và dễ sử dụng.</p>
                    </div>
                    <div class="project-detail-item">
                        <h3>💻 Công nghệ sử dụng</h3>
                        <p>Dự án được xây dựng bằng các công nghệ hiện đại:</p>
                        <div class="tech-stack">
                            <span class="tech-item">Java</span>
                            <span class="tech-item">JSP/Servlet</span>
                            <span class="tech-item">HTML5</span>
                            <span class="tech-item">CSS3</span>
                            <span class="tech-item">JavaScript</span>
                            <span class="tech-item">MySQL</span>
                            <span class="tech-item">Bootstrap</span>
                        </div>
                    </div>
                    <div class="project-detail-item">
                        <h3>📅 Thời gian thực hiện</h3>
                        <p>Dự án được triển khai trong 8 tuần, từ tháng 1 đến tháng 3 năm 2025. Nhóm đã thực hiện theo phương pháp Agile, chia nhỏ các tính năng và phát triển theo từng sprint.</p>
                    </div>
                    <div class="project-detail-item">
                        <h3>🎓 Bối cảnh học tập</h3>
                        <p>Đây là đồ án cuối kỳ môn "Lập trình Web" thuộc chương trình Công nghệ Thông tin. Dự án được thực hiện dưới sự hướng dẫn của giảng viên và áp dụng các kiến thức đã học trong suốt khóa học.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <%@ include file="../components/footer.jspf" %>
</body>
</html>
