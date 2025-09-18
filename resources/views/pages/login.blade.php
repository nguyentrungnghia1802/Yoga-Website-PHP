@extends('layouts.app')

@section('title', 'Đăng nhập Admin - Yoga/Gym Center')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
<div class="login-container">
    <div class="login-card">
        <h1 class="login-title">⚙️ Admin Login</h1>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        
    <form id="loginForm" method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-group">
                <label for="email">👤 Email</label>
                <input type="email" id="email" name="email" required 
                       placeholder="Nhập email" value="{{ old('email') }}">
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
        
        <button onclick="window.location.href='{{ route('dashboard') }}'" class="btn btn-secondary" style="width: 100%; margin-top: 10px;">
            Chuyển sang Dashboard người dùng
        </button>
        
        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e1e1e1;">
            <p style="color: #666; font-size: 14px;">
                💡 <strong>Demo:</strong> admin@example.com / password
            </p>
        </div>
    </div>
</div>
@endsection
