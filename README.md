# 🧘‍♀️ Yoga/Gym Center Management System

A comprehensive Laravel-based management system for yoga/gym centers with complete registration workflow, admin panel, and member management capabilities.

## ✨ Features

### 🎯 Core Functionality
- **Student Registration System**: Complete workflow from registration to admin approval
- **Class Management**: Full CRUD operations for yoga/gym classes
- **Teacher Management**: Detailed teacher profiles with statistics and class assignments
- **Member Management**: Customer database with registration history
- **Admin Panel**: Comprehensive dashboard with approval workflow

### 🔧 Technical Features
- **Laravel 12** with PHP 8.2+
- **MySQL Database** with proper relationships
- **Enum-based Status Management** for consistent data handling
- **Responsive UI** with Bootstrap and Tailwind CSS
- **Authentication System** for secure access
- **RESTful API** endpoints for integration

## 🚀 Quick Start

### Prerequisites
- **PHP 8.2+** with required extensions
- **Composer** for dependency management
- **MySQL 8.0+** database server
- **Node.js & NPM** for frontend assets

### Installation

1. **Clone the repository**
```bash
git clone https://github.com/nguyentrungnghia1802/Yoga-Website-PHP.git
cd Yoga-Website-PHP
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database configuration**
Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yoga_management
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Database setup**
```bash
php artisan migrate --seed
php artisan storage:link
```

6. **Install frontend dependencies**
```bash
npm install
npm run build
```

7. **Start the development server**
```bash
php artisan serve
```

Visit `http://localhost:8000` to access the application.

## 📱 Application Structure

### User Interface
- **Public Pages**: Home, Classes, Teachers, Contact
- **Registration System**: Class enrollment with approval workflow
- **Member Dashboard**: Personal class history and status

### Admin Panel (`/admin`)
- **Dashboard**: Overview statistics and recent activities
- **Registration Management**: Approve/reject student enrollments
- **Class Management**: Full CRUD for yoga/gym classes
- **Teacher Management**: Detailed teacher profiles and assignments
- **Member Management**: Customer database and history

## 🔐 Authentication

### Default Admin Account
```
Username: admin
Password: admin123
```

### Registration Flow
1. **Student Registration**: Users register for classes via web form
2. **Admin Review**: Admins review and approve/reject registrations
3. **Status Update**: Approved registrations show students in class lists
4. **Member Creation**: Approved registrations automatically create customer records

## 🗄️ Database Schema

### Core Tables
- **users**: System administrators
- **customers**: Registered members/students
- **teachers**: Yoga/gym instructors
- **classes**: Available classes with schedules
- **registrations**: Enrollment records with approval status

### Status Management
- **PENDING**: Awaiting admin approval
- **CONFIRMED**: Approved and active
- **CANCELLED**: Rejected or cancelled

## 🛠️ Development

### Running Tests
```bash
php artisan test
```

### Code Style
```bash
composer run-script format
```

### Database Management
```bash
# Fresh migration with seed data
php artisan migrate:fresh --seed

# Check migration status
php artisan migrate:status
```

## 📚 API Documentation

### Public Endpoints
- `GET /api/public/classes` - List all classes
- `GET /api/public/teachers` - List all teachers
- `POST /api/registrations` - Register for a class

### Admin Endpoints (Protected)
- `GET /api/registrations` - List all registrations
- `POST /api/registrations/{id}/confirm` - Approve registration
- `POST /api/registrations/{id}/cancel` - Reject registration

API Base URL: `http://localhost:8000/api`

## 🎨 Frontend Assets

### CSS Framework
- **Bootstrap 5** for responsive layout
- **Tailwind CSS** for utility classes
- **Custom CSS** for specific styling

### JavaScript
- **Vanilla JS** for interactions
- **Vite** for asset compilation
- **Laravel Mix** alternative configuration

## 🔄 Recent Updates

### Version 2.0 (September 2025)
- ✅ **Fixed admin teacher detail view not found error**
- ✅ **Resolved student list display issues**
- ✅ **Fixed authentication errors on registration**
- ✅ **Implemented complete admin approval workflow**
- ✅ **Cleaned up database schema and removed unused migrations**
- ✅ **Enhanced UI/UX with responsive design**

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👩‍💻 Author

**Cẩm Tú**
- Email: camtu.dev@gmail.com
- GitHub: [@camtu-dev](https://github.com/camtu-dev)

## 🙏 Acknowledgments

- Laravel Framework for the robust foundation
- Bootstrap & Tailwind CSS for responsive design
- MySQL for reliable data management
- All contributors and testers

---

### 🚀 Production Deployment

For production deployment, ensure:
- [ ] Environment variables properly configured
- [ ] Database optimized with indexes
- [ ] SSL certificate installed
- [ ] Caching enabled (Redis/Memcached)
- [ ] Queue workers running
- [ ] Log rotation configured

**Project Status: ✅ COMPLETE & PRODUCTION READY**
