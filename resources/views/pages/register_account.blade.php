@extends('layouts.app')
@section('title', 'Đăng ký tài khoản')
@section('content')
<div class="auth-form-container">
    <h2>Đăng ký tài khoản</h2>
    <form method="POST" action="{{ route('register.account.submit') }}">
        @csrf
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" name="name" id="name" required class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" id="password" required class="form-control">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Nhập lại mật khẩu</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Đăng ký</button>
    </form>
    <p class="mt-3">Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
</div>
@endsection
@push('styles')
<style>
.auth-form-container { max-width: 400px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
.auth-form-container h2 { margin-bottom: 20px; }
.form-group { margin-bottom: 15px; }
.form-group label { display: block; margin-bottom: 5px; }
.form-control { width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #ccc; }
.btn-primary { background: #007bff; color: #fff; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; }
.btn-primary:hover { background: #0056b3; }
</style>
@endpush
