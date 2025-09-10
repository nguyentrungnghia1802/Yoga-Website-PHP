@extends('layouts.app')
@section('title', 'Đăng nhập tài khoản')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush
@section('content')
<div class="login-container">
    <div class="login-card">
        <h1 class="login-title">🔐 Đăng nhập tài khoản</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        <form id="loginForm" method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="form-group">
                <label for="email">👤 Email</label>
                <input type="email" id="email" name="email" required placeholder="Nhập email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="password">🔒 Mật khẩu</label>
                <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">🚀 Đăng nhập</button>
        </form>
        <p class="mt-3">Chưa có tài khoản? <a href="{{ route('register.account') }}">Đăng ký tài khoản</a></p>
    </div>
</div>
@endsection
