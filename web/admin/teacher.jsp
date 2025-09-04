<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Giáo viên - Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <script src="../assets/js/admin.js"></script>
</head>
<body>
    <%@ include file="../components/admin_nav.jspf" %>
    <main>
        <div class="container">
            <h1 class="page-title">👨‍🏫 Quản lý Giáo viên</h1>
            <div class="card">
                <button class="btn btn-primary" onclick="openTeacherModal()">➕ Thêm giáo viên</button>
                <table class="responsive-table" style="margin-top: 20px;">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>SĐT</th>
                            <th>Chuyên môn</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="teacherTableBody">
                        <!-- Dữ liệu sẽ được render bằng JS -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal Thêm/Sửa -->
        <div id="teacherModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="closeTeacherModal()">&times;</span>
                <h2>Thêm/Sửa Giáo viên</h2>
                <form id="teacherForm" onsubmit="return saveTeacher(event)">
                    <div class="form-group">
                        <label>Họ tên</label>
                        <input type="text" id="teacherFullname" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="teacherEmail" required>
                    </div>
                    <div class="form-group">
                        <label>SĐT</label>
                        <input type="tel" id="teacherPhone" required>
                    </div>
                    <div class="form-group">
                        <label>Chuyên môn</label>
                        <input type="text" id="teacherSpecialty" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </main>
    <%@ include file="../components/footer.jspf" %>
    <script>
        // CRUD logic sẽ được thêm vào admin.js
    </script>
</body>
</html>
