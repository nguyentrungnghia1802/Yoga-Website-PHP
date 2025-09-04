# Yoga Management API (Laravel)

## Requirements
- PHP 8.2+ / laravel framework 12.0+
- Composer
- MySQL 8+


## Setup
```bash
composer install
## Tại project -> cd vào project rồi chạy tiếp 
composer install
cp .env.example .env
php artisan key:generate

# Cấu hình DB trong .env rồi:
php artisan migrate --seed
php artisan storage:link

php artisan serve
# API base: http://127.0.0.1:8000/api
