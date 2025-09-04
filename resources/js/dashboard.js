// Dashboard JavaScript Functions

// Hàm tìm kiếm
function searchTable() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('registrationTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let found = false;
        
        for (let j = 1; j < cells.length - 1; j++) { // Bỏ qua cột STT và cột thao tác
            if (cells[j] && cells[j].textContent.toLowerCase().includes(filter)) {
                found = true;
                break;
            }
        }
        
        rows[i].style.display = found ? '' : 'none';
    }
}

// Hàm xóa đăng ký
function deleteRegistration(id) {
    if (confirm('Bạn có chắc chắn muốn xóa đăng ký này?')) {
        // Tìm và xóa dòng tương ứng
        const rows = document.getElementById('registrationTable').getElementsByTagName('tr');
        for (let i = 0; i < rows.length; i++) {
            if (rows[i].getElementsByTagName('td')[0].textContent == id) {
                rows[i].remove();
                break;
            }
        }
        alert('Đã xóa đăng ký thành công!');
    }
}

// Khởi tạo khi trang đã tải
document.addEventListener('DOMContentLoaded', function() {
    // Thêm sự kiện tìm kiếm
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', searchTable);
    }
});
