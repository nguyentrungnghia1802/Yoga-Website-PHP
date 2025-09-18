<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Yoga/Gym Center')</title>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/classes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/team.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/authors.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    @stack('styles')
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('components.header')
    
    <nav class="main-nav" style="position:sticky;top:0;z-index:999;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,0.05);">
        <div class="container" style="display:flex;align-items:center;justify-content:space-between;">
            <div style="flex:1;">
                <button class="nav-toggle" onclick="toggleMainNav()" style="display: none;">☰</button>
                <ul class="nav-list">
                    <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">🏠 Trang chủ</a></li>
                    <li><a href="{{ route('classes') }}" class="{{ request()->routeIs('classes') || request()->routeIs('class.detail') ? 'active' : '' }}">🧘‍♀️ Danh sách lớp học</a></li>
                    <li><a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">📝 Đăng ký lớp học</a></li>
                    <li><a href="{{ route('authors') }}" class="{{ request()->routeIs('authors') ? 'active' : '' }}">✍️ Tác giả</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>

    @include('components.footer')

    <!-- JavaScript -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>
    @stack('scripts')
    
    <script>
    function toggleMainNav() {
        var navList = document.querySelector('.main-nav .nav-list');
        navList.style.display = (navList.style.display === 'flex' || navList.style.display === '') ? 'block' : 'flex';
    }
    function handleMainNavResize() {
        var navToggle = document.querySelector('.main-nav .nav-toggle');
        var navList = document.querySelector('.main-nav .nav-list');
        if(window.innerWidth <= 768) {
            navToggle.style.display = 'block';
            navList.style.display = 'none';
        } else {
            navToggle.style.display = 'none';
            navList.style.display = 'flex';
        }
    }
    window.addEventListener('resize', handleMainNavResize);
    document.addEventListener('DOMContentLoaded', handleMainNavResize);

    // Dropdown logic
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
    .main-nav .container {
        padding: 0 10px;
        position: relative;
    }
    .main-nav .nav-list {
        transition: all 0.3s;
    }
    @media (max-width: 768px) {
        .main-nav .nav-list {
            flex-direction: column;
            gap: 0;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-radius: 10px;
            position: absolute;
            top: 55px;
            left: 10px;
            right: 10px;
            z-index: 100;
            padding: 10px 0;
        }
        .main-nav .nav-list li {
            margin: 10px 0;
        }
        .main-nav .nav-toggle {
            display: block !important;
        }
    }
    
    .alert {
        padding: 15px;
        margin: 20px 0;
        border-radius: 10px;
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
    </style>
</body>
</html>
