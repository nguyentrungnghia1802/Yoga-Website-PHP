<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Đơn đăng ký - Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <script src="../assets/js/admin.js"></script>
</head>
<body>
    <%@ include file="../components/admin_nav.jspf" %>
    <main>
        <div class="container">
            <h1 class="page-title">📝 Quản lý Đơn đăng ký</h1>
            <div class="card">
                <button class="btn btn-primary" onclick="openRegisterModal()">➕ Thêm đơn đăng ký</button>
                <table class="responsive-table" style="margin-top: 20px;">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>SĐT</th>
                            <th>Lớp học</th>
                            <th>Gói tập</th>
                            <th>Ghi chú</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="registerTableBody">
                        <!-- Dữ liệu sẽ được render bằng JS -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal Thêm/Sửa -->
        <div id="registerModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="closeRegisterModal()">&times;</span>
                <h2>Thêm/Sửa Đơn đăng ký</h2>
                <form id="registerForm" onsubmit="return saveRegister(event)">
                    <div class="form-group">
                        <label>Họ tên</label>
                        <input type="text" id="regFullname" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="regEmail" required>
                    </div>
                    <div class="form-group">
                        <label>SĐT</label>
                        <input type="tel" id="regPhone" required>
                    </div>
                    <div class="form-group">
                        <label>Lớp học</label>
                        <input type="text" id="regClass" required>
                    </div>
                    <div class="form-group">
                        <label>Gói tập</label>
                        <input type="text" id="regPackage" required>
                    </div>
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <textarea id="regNote"></textarea>
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
