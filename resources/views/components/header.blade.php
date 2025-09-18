<nav class="main-nav" style="position:sticky;top:0;z-index:999;background:#18181a;box-shadow:0 2px 8px rgba(0,0,0,0.05);">
	<div class="container" style="display:flex;align-items:center;">
		<span style="font-size:1.3rem;font-weight:700;color:#667eea;letter-spacing:0.5px;margin-right:36px;">Yoga & Gym Center</span>
		<ul class="nav-list" style="display:flex;align-items:center;gap:24px;">
			<li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">🏠 Trang chủ</a></li>
			<li><a href="{{ route('classes') }}" class="{{ request()->routeIs('classes') || request()->routeIs('class.detail') ? 'active' : '' }}">🧘‍♀️ Danh sách lớp học</a></li>
			<li><a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">📝 Đăng ký lớp học</a></li>
			<li><a href="{{ route('authors') }}" class="{{ request()->routeIs('authors') ? 'active' : '' }}">✍️ Tác giả</a></li>
		</ul>
	</div>
</nav>
