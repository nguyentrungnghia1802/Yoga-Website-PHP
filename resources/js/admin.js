// Xử lý xóa đăng ký bằng Ajax
function deleteRegistration(id) {
    if(confirm('Bạn có chắc muốn xóa đăng ký này?')) {
        fetch('../DeleteRegistrationServlet?id=' + id, { method: 'POST' })
        .then(res => location.reload());
    }
}
