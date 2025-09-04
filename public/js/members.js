// Members Page JavaScript Functions

// Hàm toggle members list
function toggleMembers(classItem) {
    const membersList = classItem.querySelector('.members-list');
    const button = classItem.querySelector('.toggle-members-btn');
    
    // Close all other open lists
    document.querySelectorAll('.members-list.active').forEach(list => {
        if (list !== membersList) {
            list.classList.remove('active');
            const otherButton = list.parentElement.querySelector('.toggle-members-btn');
            otherButton.textContent = '👥 Xem danh sách học viên';
        }
    });
    
    // Toggle current list
    membersList.classList.toggle('active');
    
    if (membersList.classList.contains('active')) {
        button.textContent = '🔼 Ẩn danh sách';
        classItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
    } else {
        button.textContent = '👥 Xem danh sách học viên';
    }
}

// Animation on load
function initPageAnimations() {
    const classItems = document.querySelectorAll('.class-item');
    classItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(30px)';
        item.style.transition = 'all 0.6s ease';
        
        setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 200);
    });
}

// Image zoom functionality (legacy)
function zoomImage(img) {
    var modal = document.getElementById("zoomModal");
    var zoomImg = document.getElementById("zoomImg");
    zoomImg.src = img.src;
    modal.style.display = "flex";
}

function closeZoom() {
    document.getElementById("zoomModal").style.display = "none";
}

// Khởi tạo khi trang đã tải
document.addEventListener('DOMContentLoaded', function() {
    initPageAnimations();
});
