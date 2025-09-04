<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Lớp học - Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <script src="../assets/js/admin.js"></script>
</head>
<body>
    <%@ include file="../components/admin_nav.jspf" %>
    <main>
        <div class="container">
            <h1 class="page-title">🏃‍♀️ Quản lý Lớp học</h1>
            <div class="card">
                <button class="btn btn-primary" onclick="openClassModal()">➕ Thêm lớp học</button>
                <table class="responsive-table" style="margin-top: 20px;">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên lớp</th>
                            <th>Thời gian</th>
                            <th>Giảng viên</th>
                            <th>Giá/tháng</th>
                            <th>Số học viên</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="classTableBody">
                        <!-- Dữ liệu sẽ được render bằng JS -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal Thêm/Sửa -->
        <div id="classModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="closeClassModal()">&times;</span>
                <h2>Thêm/Sửa Lớp học</h2>
                <form id="classForm" onsubmit="return saveClass(event)">
                    <div class="form-group">
                        <label>Tên lớp</label>
                        <input type="text" id="className" required>
                    </div>
                    <div class="form-group">
                        <label>Thời gian</label>
                        <input type="text" id="classTime" required>
                    </div>
                    <div class="form-group">
                        <label>Giảng viên</label>
                        <input type="text" id="classTeacher" required>
                    </div>
                    <div class="form-group">
                        <label>Giá/tháng</label>
                        <input type="text" id="classPrice" required>
                    </div>
                    <div class="form-group">
                        <label>Số học viên</label>
                        <input type="number" id="classMembers" required>
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
