// Contact Page JavaScript Functions

// Handle contact form submission
function handleContactSubmit(event) {
    event.preventDefault();
    
    const name = document.getElementById('contactName').value.trim();
    const email = document.getElementById('contactEmail').value.trim();
    const subject = document.getElementById('contactSubject').value;
    const message = document.getElementById('contactMessage').value.trim();
    
    if (!name || !email || !subject || !message) {
        alert('Vui lòng điền đầy đủ thông tin bắt buộc!');
        return false;
    }
    
    // Validate email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Email không đúng định dạng!');
        return false;
    }
    
    // Show success message
    alert('📧 Cảm ơn bạn đã liên hệ!\n\n' +
          'Tin nhắn của bạn đã được gửi thành công.\n' +
          'Chúng tôi sẽ phản hồi trong vòng 24 giờ.\n\n' +
          '✨ Cảm ơn bạn đã quan tâm đến Yoga/Gym Center!');
    
    // Reset form
    document.getElementById('contactForm').reset();
    
    return false;
}

// Hiệu ứng động cho contact items
function initContactAnimations() {
    const contactItems = document.querySelectorAll('.contact-item');
    contactItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(-30px)';
        item.style.transition = 'all 0.6s ease';
        
        setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'translateX(0)';
        }, index * 200);
    });
}

// Khởi tạo khi trang đã tải
document.addEventListener('DOMContentLoaded', function() {
    initContactAnimations();
});
