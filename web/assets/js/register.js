// Registration Form JavaScript Functions

// Handle form submission
function handleSubmit(event) {
    event.preventDefault();
    
    // Validate form
    const fullname = document.getElementById('fullname').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const className = document.getElementById('className').value;
    const package = document.getElementById('package').value;
    
    if (!fullname || !email || !phone || !className || !package) {
        alert('Vui lòng điền đầy đủ thông tin bắt buộc!');
        return false;
    }
    
    // Validate email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Email không đúng định dạng!');
        return false;
    }
    
    // Validate phone
    const phoneRegex = /^[0-9]{10,11}$/;
    if (!phoneRegex.test(phone)) {
        alert('Số điện thoại không đúng định dạng!');
        return false;
    }
    
    // Show success message
    alert('🎉 Đăng ký thành công!\n\n' +
          'Thông tin đăng ký:\n' +
          '👤 Họ tên: ' + fullname + '\n' +
          '📧 Email: ' + email + '\n' +
          '📱 SĐT: ' + phone + '\n' +
          '🏃‍♀️ Lớp: ' + className + '\n' +
          '💳 Gói: ' + package + '\n\n' +
          'Chúng tôi sẽ liên hệ với bạn trong 24h để xác nhận!');
    
    // Reset form
    document.getElementById('registerForm').reset();
    
    return false;
}

// Legacy function for compatibility
function validateForm() {
    return handleSubmit(event);
}
