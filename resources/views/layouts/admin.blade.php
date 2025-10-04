<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Yoga/Gym Center')</title>
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
    @auth
        <nav class="admin-nav">
            <div class="nav-container">
                <div class="nav-brand">
                    <h2><i class="fas fa-spa"></i> Admin Panel</h2>
                </div>
                <div class="nav-menu">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.registrations') }}" 
                       class="{{ request()->routeIs('admin.registrations*') ? 'active' : '' }}">
                        <i class="fas fa-file-alt"></i> Đơn đăng ký
                    </a>
                    <a href="{{ route('admin.classes') }}" 
                       class="{{ request()->routeIs('admin.classes*') ? 'active' : '' }}">
                        <i class="fas fa-dumbbell"></i> Lớp học
                    </a>
                    <a href="{{ route('admin.customers') }}" 
                       class="{{ request()->routeIs('admin.customers*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Học viên
                    </a>
                    <a href="{{ route('admin.teachers') }}" 
                       class="{{ request()->routeIs('admin.teachers*') ? 'active' : '' }}">
                        <i class="fas fa-chalkboard-teacher"></i> Giảng viên
                    </a>
                </div>
                <div class="nav-user">
                    <div class="dropdown">
                        <button onclick="toggleDropdown()" class="dropdown-toggle">
                            👤 {{ Auth::user()->user_name ?? Auth::user()->name }} ▼
                        </button>
                        <div class="dropdown-menu" id="dropdown-menu">
                            <a href="{{ route('dashboard') }}">🏠 Trang chính</a>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit">🚪 Đăng xuất</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    @endauth

    <main class="admin-main">
        @if(session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-error">
                ❌ {{ session('error') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- JavaScript -->
    @stack('scripts')
    
    <script>
    function toggleDropdown() {
        var menu = document.getElementById('dropdown-menu');
        if(menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            menu.style.display = 'block';
        }
    }
    document.addEventListener('click', function(e) {
        var dropdown = document.querySelector('.dropdown');
        var menu = document.getElementById('dropdown-menu');
        if(!dropdown.contains(e.target)) {
            if(menu) menu.style.display = 'none';
        }
    });
    </script>
    
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    .admin-body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .admin-nav {
        background: #343a40;
        color: white;
        padding: 0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        height: 60px;
    }
    
    .nav-brand h2 {
        color: #ffc107;
        font-size: 1.5rem;
    }
    
    .nav-menu {
        display: flex;
        gap: 0;
    }
    
    .nav-menu a {
        color: white;
        text-decoration: none;
        padding: 20px 15px;
        transition: background 0.3s;
        border-bottom: 3px solid transparent;
    }
    
    .nav-menu a:hover {
        background: rgba(255,255,255,0.1);
    }
    
    .nav-menu a.active {
        background: rgba(255,193,7,0.2);
        border-bottom-color: #ffc107;
    }
    
    .dropdown {
        position: relative;
    }
    
    .dropdown-toggle {
        background: none;
        border: none;
        color: white;
        padding: 8px 15px;
        cursor: pointer;
        border-radius: 4px;
        transition: background 0.3s;
    }
    
    .dropdown-toggle:hover {
        background: rgba(255,255,255,0.1);
    }
    
    .dropdown-menu {
        position: absolute;
        right: 0;
        top: 100%;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        min-width: 160px;
        z-index: 1000;
        display: none;
    }
    
    .dropdown-menu a, .dropdown-menu button {
        display: block;
        width: 100%;
        padding: 10px 15px;
        color: #333;
        text-decoration: none;
        border: none;
        background: none;
        text-align: left;
        cursor: pointer;
        transition: background 0.3s;
    }
    
    .dropdown-menu a:hover, .dropdown-menu button:hover {
        background: #f8f9fa;
    }
    
    .admin-main {
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px 20px;
    }
    
    .alert {
        padding: 15px 20px;
        margin-bottom: 20px;
        border-radius: 8px;
        font-weight: 500;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    @media (max-width: 768px) {
        .nav-container {
            flex-direction: column;
            height: auto;
            padding: 10px 20px;
        }
        
        .nav-menu {
            flex-wrap: wrap;
            justify-content: center;
            margin: 10px 0;
        }
        
        .nav-menu a {
            padding: 10px 12px;
            font-size: 0.9rem;
        }
    }
    </style>
</body>
</html>