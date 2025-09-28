# 🧘‍♀️ Hướng Dẫn Cài Đặt Dự Án Yoga Website

## 📋 Mục Lục
1. [Yêu Cầu Hệ Thống](#yêu-cầu-hệ-thống)
2. [Cài Đặt Môi Trường](#cài-đặt-môi-trường)
3. [Clone Dự Án](#clone-dự-án)
4. [Cấu Hình Dự Án](#cấu-hình-dự-án)
5. [Cài Đặt Dependencies](#cài-đặt-dependencies)
6. [Cấu Hình Database](#cấu-hình-database)
7. [Chạy Migration & Seeder](#chạy-migration--seeder)
8. [Khởi Động Dự Án](#khởi-động-dự-án)
9. [Truy Cập Ứng Dụng](#truy-cập-ứng-dụng)
10. [Xử Lý Lỗi Thường Gặp](#xử-lý-lỗi-thường-gặp)

---

## 🔧 Yêu Cầu Hệ Thống

### Yêu Cầu Bắt Buộc:
- **PHP:** >= 8.2
- **Composer:** Phiên bản mới nhất
- **Node.js:** >= 18.x
- **NPM:** >= 9.x
- **Web Server:** Apache/Nginx (hoặc dùng built-in PHP server)
- **Database:** MySQL 8.0+ / PostgreSQL 13+ / SQLite (mặc định)
- **Git:** Để clone repository

### Yêu Cầu PHP Extensions:
```
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension
- Fileinfo PHP Extension
```

---

## 🛠️ Cài Đặt Môi Trường

### 1. Cài Đặt PHP (Windows)

#### Option A: Sử dụng XAMPP (Khuyến nghị cho người mới)
1. Tải XAMPP từ: https://www.apachefriends.org/
2. Cài đặt và khởi động Apache, MySQL
3. Thêm PHP vào PATH:
   ```bash
   # Thêm vào Windows PATH
   C:\xampp\php
   ```

#### Option B: Sử dụng PHP Manual Install
1. Tải PHP 8.2+ từ: https://windows.php.net/download/
2. Giải nén và thêm vào PATH
3. Copy `php.ini-development` thành `php.ini`
4. Enable các extension cần thiết trong `php.ini`:
   ```ini
   extension=openssl
   extension=pdo_mysql
   extension=mbstring
   extension=tokenizer
   extension=xml
   extension=ctype
   extension=json
   extension=bcmath
   extension=fileinfo
   ```

### 2. Cài Đặt Composer
```bash
# Tải Composer từ: https://getcomposer.org/
# Hoặc cài đặt qua command line
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

### 3. Cài Đặt Node.js & NPM
1. Tải Node.js từ: https://nodejs.org/
2. Chọn LTS version (khuyến nghị)
3. Kiểm tra cài đặt:
   ```bash
   node --version
   npm --version
   ```

### 4. Cài Đặt Git
- Tải Git từ: https://git-scm.com/
- Hoặc sử dụng GitHub Desktop: https://desktop.github.com/

---

## 📂 Clone Dự Án

### 1. Clone Repository
```bash
# Clone dự án từ GitHub
git clone https://github.com/nguyentrungnghia1802/Yoga-Website-PHP.git

# Di chuyển vào thư mục dự án
cd Yoga-Website-PHP
```

### 2. Kiểm Tra Cấu Trúc Dự Án
```bash
# Liệt kê các file/folder chính
dir  # Windows
ls -la  # Linux/Mac

# Đảm bảo có các file sau:
# - composer.json
# - package.json
# - artisan
# - .env.example
```

---

## ⚙️ Cấu Hình Dự Án

### 1. Tạo File Environment
```bash
# Windows
copy .env.example .env

# Linux/Mac
cp .env.example .env
```

### 2. Cấu Hình File .env
Mở file `.env` và cập nhật các thông số sau:

```env
# Thông tin ứng dụng
APP_NAME="Yoga Website"
APP_ENV=local
APP_KEY=  # Sẽ được generate tự động
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=sqlite
# Hoặc nếu dùng MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=yoga_website
# DB_USERNAME=root
# DB_PASSWORD=your_password

# Session & Cache
SESSION_DRIVER=file
CACHE_STORE=database
QUEUE_CONNECTION=database

# Mail (cho testing - dùng log)
MAIL_MAILER=log
MAIL_FROM_ADDRESS="admin@yogawebsite.com"
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 📦 Cài Đặt Dependencies

### 1. Cài Đặt PHP Dependencies
```bash
# Cài đặt Laravel packages
composer install

# Nếu gặp lỗi memory, tăng memory limit:
php -d memory_limit=512M /path/to/composer install
```

### 2. Cài Đặt Node.js Dependencies
```bash
# Cài đặt frontend packages
npm install

# Hoặc dùng yarn (nếu có)
yarn install
```

### 3. Generate Application Key
```bash
php artisan key:generate
```

---

## 🗄️ Cấu Hình Database

### Option A: Sử dụng SQLite (Khuyến nghị cho testing)
```bash
# Tạo file database SQLite
# Windows
type nul > database\database.sqlite

# Linux/Mac
touch database/database.sqlite
```

### Option B: Sử dụng MySQL
1. **Tạo Database:**
   ```sql
   CREATE DATABASE yoga_website CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. **Cập nhật .env:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=yoga_website
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

3. **Test Connection:**
   ```bash
   php artisan tinker
   >>> DB::connection()->getPdo();
   ```

---

## 🚀 Chạy Migration & Seeder

### 1. Chạy Database Migrations
```bash
# Tạo các bảng trong database
php artisan migrate

# Nếu cần reset và chạy lại:
php artisan migrate:fresh
```

### 2. Chạy Database Seeders
```bash
# Seed dữ liệu mẫu
php artisan db:seed

# Hoặc chạy cả migrate + seed:
php artisan migrate --seed

# Hoặc migrate fresh + seed:
php artisan migrate:fresh --seed
```

### 3. Tạo Storage Link
```bash
php artisan storage:link
```

### 4. Clear Cache (Nếu Cần)
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

---

## 🌐 Khởi Động Dự Án

### 1. Khởi Động Backend (Laravel)
```bash
# Chạy Laravel development server
php artisan serve

# Server sẽ chạy tại: http://localhost:8000
# Hoặc chỉ định port khác:
php artisan serve --port=8080
```

### 2. Khởi Động Frontend (Vite)
Mở terminal mới và chạy:
```bash
# Development mode với hot reload
npm run dev

# Hoặc build production:
npm run build
```

### 3. Chạy Queue Worker (Nếu Cần)
Mở terminal thứ 3:
```bash
php artisan queue:work
```

### 4. Sử Dụng Script Tự Động (Nếu Có)
```bash
# Nếu có file dev.bat (Windows)
dev.bat

# Hoặc chạy lệnh composer:
composer run dev
```

---

## 🔍 Truy Cập Ứng Dụng

### 1. URLs Chính
- **Trang chủ:** http://localhost:8000
- **Admin Login:** http://localhost:8000/login
- **API Documentation:** http://localhost:8000/api (nếu có)

### 2. Tài Khoản Mặc Định
Sau khi chạy seeder, bạn có thể đăng nhập với:
```
Username: admin
Password: password

# Hoặc kiểm tra trong DatabaseSeeder.php để biết thông tin chính xác
```

### 3. Kiểm Tra Chức Năng
1. ✅ Truy cập trang chủ
2. ✅ Đăng nhập admin
3. ✅ Xem danh sách lớp học
4. ✅ Xem danh sách giảng viên
5. ✅ Thử đăng ký lớp học
6. ✅ Kiểm tra admin panel

---

## 🚨 Xử Lý Lỗi Thường Gặp

### 1. Lỗi "Application key not set"
```bash
php artisan key:generate
```

### 2. Lỗi "Class not found"
```bash
composer dump-autoload
```

### 3. Lỗi Permission (Linux/Mac)
```bash
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache
```

### 4. Lỗi Database Connection
- Kiểm tra thông tin database trong `.env`
- Đảm bảo MySQL service đang chạy
- Test connection: `php artisan tinker` → `DB::connection()->getPdo();`

### 5. Lỗi Composer Memory
```bash
php -d memory_limit=512M /usr/local/bin/composer install
```

### 6. Lỗi Node.js Dependencies
```bash
# Xóa node_modules và cài lại
rm -rf node_modules package-lock.json
npm install
```

### 7. Lỗi Port đã được sử dụng
```bash
# Kiểm tra process đang dùng port
netstat -ano | findstr :8000

# Hoặc dùng port khác
php artisan serve --port=8080
```

### 8. Lỗi Vite Not Found
```bash
# Cài đặt lại Vite
npm install vite --save-dev
npm run dev
```

---

## 🎯 Checklist Cài Đặt Hoàn Tất

- [ ] ✅ PHP 8.2+ đã cài đặt
- [ ] ✅ Composer đã cài đặt  
- [ ] ✅ Node.js & NPM đã cài đặt
- [ ] ✅ Git đã cài đặt
- [ ] ✅ Repository đã clone thành công
- [ ] ✅ File `.env` đã được tạo và cấu hình
- [ ] ✅ `composer install` đã chạy thành công
- [ ] ✅ `npm install` đã chạy thành công
- [ ] ✅ `php artisan key:generate` đã chạy
- [ ] ✅ Database đã được tạo
- [ ] ✅ `php artisan migrate --seed` đã chạy thành công
- [ ] ✅ `php artisan storage:link` đã chạy
- [ ] ✅ Server Laravel đã khởi động (`php artisan serve`)
- [ ] ✅ Vite dev server đã khởi động (`npm run dev`)
- [ ] ✅ Có thể truy cập http://localhost:8000
- [ ] ✅ Có thể đăng nhập admin panel
- [ ] ✅ Tất cả chức năng hoạt động bình thường

---

## 📞 Hỗ Trợ

### Nếu Gặp Vấn Đề:
1. **Kiểm tra logs:** `storage/logs/laravel.log`
2. **Enable debug mode:** Set `APP_DEBUG=true` trong `.env`
3. **Kiểm tra browser console** cho lỗi JavaScript
4. **Chạy:** `php artisan config:clear` và `php artisan cache:clear`

### Liên Hệ Hỗ Trợ:
- **Email:** camtu.dev@gmail.com
- **GitHub Issues:** https://github.com/nguyentrungnghia1802/Yoga-Website-PHP/issues

---

## 🎉 Chúc Mừng!

Bạn đã cài đặt thành công dự án Yoga Website! 
Giờ bạn có thể bắt đầu phát triển và tùy chỉnh theo nhu cầu của mình.

**Happy Coding! 🚀**

---

*Cập nhật lần cuối: 28/09/2025*  
*Phiên bản: 1.0.0*