# Mô tả chuyển đổi giao diện JSP sang Blade Laravel

## Tổng quan
- Chuyển đổi toàn bộ giao diện từ thư mục `web/` (JSP) sang Blade template của Laravel.
- Tích hợp Vite, Bootstrap, Tailwind vào layout tổng.
- Tạo cấu trúc thư mục Blade chuẩn Laravel: layouts, components, pages, admin.

## Chi tiết các file đã tạo
- `resources/views/layouts/app.blade.php`: Layout tổng, import assets, header, nav, footer.
- `resources/views/components/header.blade.php`: Header chung.
- `resources/views/components/nav.blade.php`: Thanh điều hướng, liên kết các trang chính.
- `resources/views/components/footer.blade.php`: Footer chung.
- `resources/views/pages/`: Các trang người dùng (login, dashboard, register, classes, team, contact, members, authors).
- `resources/views/admin/`: Các trang quản trị (dashboard, class, register, teacher).

## Logic chuyển đổi
- Dựa trên cấu trúc và giao diện JSP, chuyển sang Blade, giữ nguyên logic và UI.
- Sử dụng Bootstrap cho layout, form, bảng, card.
- Sử dụng Vite để build CSS/JS, tích hợp Tailwind nếu cần.
- Các trang đã sẵn sàng để nhận dữ liệu từ Controller Laravel.

## Hướng dẫn mở rộng
- Có thể bổ sung các component như alert, button, modal, pagination...
- Tích hợp dữ liệu động từ Controller vào các trang Blade.
- Sử dụng layout và component để tái sử dụng giao diện.

---
Nếu cần chuyển thêm trang hoặc bổ sung chức năng, vui lòng yêu cầu tiếp.
