// Team Page JavaScript Functions

// Thêm hiệu ứng click cho avatar
function initAvatarEffects() {
    document.querySelectorAll('.member-avatar').forEach(avatar => {
        avatar.addEventListener('click', function() {
            this.style.transform = 'scale(1.2) rotate(360deg)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 600);
        });
    });
}

// Hiệu ứng xuất hiện từ từ
function initScrollAnimations() {
    const cards = document.querySelectorAll('.member-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s ease';
        observer.observe(card);
    });
}

// Khởi tạo khi trang đã tải
document.addEventListener('DOMContentLoaded', function() {
    initAvatarEffects();
    initScrollAnimations();
});
