@extends('layouts.admin')

@section('title', 'Chỉnh sửa Lớp học - Admin')

@section('content')
<div class="page-header">
    <div class="header-navigation">
        <a href="{{ route('admin.classes') }}" class="back-btn">
            ← Quay lại danh sách
        </a>
    </div>
    <div class="header-content">
        <h1>✏️ Chỉnh sửa Lớp học: {{ $class->name }}</h1>
        <p>Cập nhật thông tin lớp học</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        ✅ {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-error">
        ❌ Vui lòng kiểm tra lại thông tin:
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-container">
    <form method="POST" action="{{ route('admin.classes.update', $class) }}">
        @csrf
        @method('PUT')
        
        <div class="form-grid">
            <div class="form-group">
                <label for="name">🧘‍♀️ Tên lớp học <span class="required">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $class->name) }}" required>
            </div>

            <div class="form-group">
                <label for="teacher_id">👨‍🏫 Giảng viên <span class="required">*</span></label>
                <select id="teacher_id" name="teacher_id" required>
                    <option value="">-- Chọn giảng viên --</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('teacher_id', $class->teacher_id) == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }} ({{ $teacher->exp_year }} năm kinh nghiệm)
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="lich_hoc">📅 Lịch học <span class="required">*</span></label>
                <input type="text" id="lich_hoc" name="lich_hoc" value="{{ old('lich_hoc', $class->lich_hoc) }}" placeholder="Ví dụ: Thứ 2, 4, 6" required>
            </div>

            <div class="form-group">
                <label for="location">📍 Địa điểm <span class="required">*</span></label>
                <input type="text" id="location" name="location" value="{{ old('location', $class->location) }}" placeholder="Ví dụ: Phòng tập A1" required>
            </div>

            <div class="form-group">
                <label for="start_time">⏰ Giờ bắt đầu <span class="required">*</span></label>
                <input type="time" id="start_time" name="start_time" value="{{ old('start_time', $class->start_time->format('H:i')) }}" required>
            </div>

            <div class="form-group">
                <label for="end_time">⏰ Giờ kết thúc <span class="required">*</span></label>
                <input type="time" id="end_time" name="end_time" value="{{ old('end_time', $class->end_time->format('H:i')) }}" required>
            </div>

            <div class="form-group">
                <label for="start_date">📅 Ngày bắt đầu <span class="required">*</span></label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $class->start_date->format('Y-m-d')) }}" required>
            </div>

            <div class="form-group">
                <label for="end_date">📅 Ngày kết thúc <span class="required">*</span></label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $class->end_date->format('Y-m-d')) }}" required>
            </div>

            <div class="form-group">
                <label for="quantity">👥 Số lượng học viên <span class="required">*</span></label>
                <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $class->quantity) }}" min="1" max="50" required>
            </div>

            <div class="form-group">
                <label for="price">💰 Giá (VNĐ) <span class="required">*</span></label>
                <input type="number" id="price" name="price" value="{{ old('price', $class->price) }}" min="0" step="1000" required>
            </div>
        </div>

        <div class="form-group full-width">
            <label for="description">📝 Mô tả</label>
            <textarea id="description" name="description" rows="4" placeholder="Mô tả chi tiết về lớp học...">{{ old('description', $class->description) }}</textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                ✅ Cập nhật lớp học
            </button>
            <a href="{{ route('admin.classes.detail', $class) }}" class="btn btn-secondary">
                👁️ Xem chi tiết
            </a>
            <a href="{{ route('admin.classes') }}" class="btn btn-secondary">
                ❌ Hủy bỏ
            </a>
        </div>
    </form>
</div>

@push('styles')
<style>
.page-header {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.header-navigation {
    margin-bottom: 15px;
}

.back-btn {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    padding: 8px 16px;
    border-radius: 6px;
    background: #f8f9fa;
    transition: all 0.2s;
}

.back-btn:hover {
    background: #e9ecef;
}

.header-content h1 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 5px;
}

.header-content p {
    color: #666;
    margin: 0;
}

.alert {
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
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

.alert ul {
    margin: 10px 0 0 20px;
}

.form-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 30px;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.full-width {
    grid-column: span 2;
}

.form-group label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.required {
    color: #dc3545;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.2s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #667eea;
}

.form-group textarea {
    resize: vertical;
    min-height: 100px;
}

.form-actions {
    display: flex;
    gap: 15px;
    justify-content: flex-end;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #f8f9fa;
}

.btn {
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
}

.btn-primary {
    background: #28a745;
    color: white;
}

.btn-primary:hover {
    background: #218838;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
    color: white;
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .form-group.full-width {
        grid-column: span 1;
    }
    
    .form-actions {
        flex-direction: column;
    }
}
</style>
@endpush
@endsection