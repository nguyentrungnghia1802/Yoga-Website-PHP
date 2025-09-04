<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin - Yoga/Gym Center</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <h1 class="login-title">⚙️ Admin Login</h1>
            
            <% if(request.getAttribute("errorMsg") != null) { %>
                <div class="alert alert-danger">
                    <%= request.getAttribute("errorMsg") %>
                </div>
            <% } %>
            
            <form id="loginForm" method="post">
                <div class="form-group">
                    <label for="username">👤 Tên đăng nhập</label>
                    <input type="text" id="username" name="username" required 
                           placeholder="Nhập tên đăng nhập">
                </div>
                
                <div class="form-group">
                    <label for="password">🔒 Mật khẩu</label>
                    <input type="password" id="password" name="password" required 
                           placeholder="Nhập mật khẩu">
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">
                    🚀 Đăng nhập
                </button>
            </form>
            <button onclick="window.location.href='./pages/dashboard.jsp'" class="btn btn-secondary" style="width: 100%; margin-top: 10px;">Chuyển sang Dashboard người dùng</button>

            <script>
            document.getElementById('loginForm').onsubmit = function(e) {
                e.preventDefault();
                var username = document.getElementById('username').value;
                var password = document.getElementById('password').value;
                if(username === 'admin' && password === '123456') {
                    window.location.href = './admin/dashboard.jsp';
                } else {
                    window.location.href = './pages/dashboard.jsp';
                }
            };
            </script>
            </form>
            
            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e1e1e1;">
                <p style="color: #666; font-size: 14px;">
                    💡 <strong>Demo:</strong> admin / 123456
                </p>
            </div>
        </div>
    </div>
</body>
</html>
