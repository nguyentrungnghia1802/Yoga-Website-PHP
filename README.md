# 🧘‍♀️ Yoga/Gym Center Management System

A comprehensive Laravel-based management system for yoga/gym centers with complete registration workflow, admin panel, and member management capabilities.

## 🌍 Language Selection / 言語選択

<details>
<summary>📖 English Documentation</summary>

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
Password: 123456
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

</details>

<details>
<summary>📖 日本語ドキュメント</summary>

## ✨ 機能

### 🎯 コア機能
- **生徒登録システム**: 登録から管理者承認まで完全なワークフロー
- **クラス管理**: ヨガ/ジムクラスの完全なCRUD操作
- **講師管理**: 統計情報とクラス割り当てを含む詳細な講師プロフィール
- **メンバー管理**: 登録履歴を含む顧客データベース
- **管理パネル**: 承認ワークフローを含む包括的なダッシュボード

### 🔧 技術機能
- **Laravel 12** PHP 8.2+対応
- **MySQLデータベース** 適切なリレーションシップ付き
- **Enum基盤のステータス管理** 一貫したデータ処理のため
- **レスポンシブUI** Bootstrap と Tailwind CSS使用
- **認証システム** セキュアなアクセス制御
- **RESTful API** エンドポイント統合対応

## 🚀 クイックスタート

### 前提条件
- **PHP 8.2+** 必要な拡張機能付き
- **Composer** 依存関係管理用
- **MySQL 8.0+** データベースサーバー
- **Node.js & NPM** フロントエンドアセット用

### インストール

1. **リポジトリをクローン**
```bash
git clone https://github.com/nguyentrungnghia1802/Yoga-Website-PHP.git
cd Yoga-Website-PHP
```

2. **PHP依存関係をインストール**
```bash
composer install
```

3. **環境設定**
```bash
cp .env.example .env
php artisan key:generate
```

4. **データベース設定**
`.env`ファイルをデータベース資格情報で編集:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yoga_management
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **データベースセットアップ**
```bash
php artisan migrate --seed
php artisan storage:link
```

6. **フロントエンド依存関係をインストール**
```bash
npm install
npm run build
```

7. **開発サーバーを起動**
```bash
php artisan serve
```

`http://localhost:8000` にアクセスしてアプリケーションを使用してください。

## 📱 アプリケーション構造

### ユーザーインターフェース
- **公開ページ**: ホーム、クラス、講師、お問い合わせ
- **登録システム**: 承認ワークフロー付きクラス登録
- **メンバーダッシュボード**: 個人のクラス履歴とステータス

### 管理パネル (`/admin`)
- **ダッシュボード**: 概要統計と最近のアクティビティ
- **登録管理**: 生徒の登録承認/拒否
- **クラス管理**: ヨガ/ジムクラスの完全CRUD
- **講師管理**: 詳細な講師プロフィールと割り当て
- **メンバー管理**: 顧客データベースと履歴

## 🔐 認証

### デフォルト管理者アカウント
```
ユーザー名: admin
パスワード: 123456
```

### 登録フロー
1. **生徒登録**: ユーザーがWebフォームでクラスに登録
2. **管理者レビュー**: 管理者が登録を承認/拒否
3. **ステータス更新**: 承認された登録でクラスリストに生徒を表示
4. **メンバー作成**: 承認された登録が自動的に顧客レコードを作成

## 🗄️ データベーススキーマ

### コアテーブル
- **users**: システム管理者
- **customers**: 登録メンバー/生徒
- **teachers**: ヨガ/ジム講師
- **classes**: スケジュール付き利用可能クラス
- **registrations**: 承認ステータス付き登録レコード

### ステータス管理
- **PENDING**: 管理者承認待ち
- **CONFIRMED**: 承認済みでアクティブ
- **CANCELLED**: 拒否またはキャンセル

## 🛠️ 開発

### テスト実行
```bash
php artisan test
```

### コードスタイル
```bash
composer run-script format
```

### データベース管理
```bash
# シードデータ付きの新規マイグレーション
php artisan migrate:fresh --seed

# マイグレーション状況確認
php artisan migrate:status
```

## 📚 APIドキュメント

### 公開エンドポイント
- `GET /api/public/classes` - 全クラス一覧
- `GET /api/public/teachers` - 全講師一覧
- `POST /api/registrations` - クラス登録

### 管理者エンドポイント（保護済み）
- `GET /api/registrations` - 全登録一覧
- `POST /api/registrations/{id}/confirm` - 登録承認
- `POST /api/registrations/{id}/cancel` - 登録拒否

APIベースURL: `http://localhost:8000/api`

## 🎨 フロントエンドアセット

### CSSフレームワーク
- **Bootstrap 5** レスポンシブレイアウト用
- **Tailwind CSS** ユーティリティクラス用
- **カスタムCSS** 特定のスタイリング用

### JavaScript
- **Vanilla JS** インタラクション用
- **Vite** アセットコンパイル用
- **Laravel Mix** 代替設定

## 🔄 最新の更新

### バージョン 2.0 (2025年9月)
- ✅ **管理者講師詳細ビューが見つからないエラーを修正**
- ✅ **生徒リスト表示問題を解決**
- ✅ **登録時の認証エラーを修正**
- ✅ **完全な管理者承認ワークフローを実装**
- ✅ **データベーススキーマをクリーンアップし、未使用のマイグレーションを削除**
- ✅ **レスポンシブデザインでUI/UXを強化**

## 🤝 貢献

1. リポジトリをフォーク
2. 機能ブランチを作成 (`git checkout -b feature/amazing-feature`)
3. 変更をコミット (`git commit -m 'Add some amazing feature'`)
4. ブランチにプッシュ (`git push origin feature/amazing-feature`)
5. プルリクエストを開く

## 📄 ライセンス

このプロジェクトはMITライセンスの下でライセンスされています - 詳細は[LICENSE](LICENSE)ファイルをご覧ください。

## 👩‍💻 作者

**Cẩm Tú**
- メール: camtu.dev@gmail.com
- GitHub: [@camtu-dev](https://github.com/camtu-dev)

## 🙏 謝辞

- 堅牢な基盤を提供するLaravelフレームワーク
- レスポンシブデザインのBootstrap & Tailwind CSS
- 信頼性の高いデータ管理のMySQL
- すべての貢献者とテスター

---

### 🚀 本番デプロイメント

本番デプロイメントでは以下を確認してください:
- [ ] 環境変数が適切に設定されている
- [ ] インデックス付きでデータベースが最適化されている
- [ ] SSL証明書がインストールされている
- [ ] キャッシュが有効化されている（Redis/Memcached）
- [ ] キューワーカーが動作している
- [ ] ログローテーションが設定されている

**プロジェクトステータス: ✅ 完了 & 本番対応済み**

</details>
