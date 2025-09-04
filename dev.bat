@echo off
echo 🚀 Build & start containers...
docker compose up -d --build

echo 📦 Run migrations & seed...
docker compose exec app php artisan migrate --seed

echo 🔑 Generate app key...
docker compose exec app php artisan key:generate --force

echo 🔗 Storage link...
docker compose exec app php artisan storage:link

echo ✅ Done! Project is running at: http://localhost:8000
pause
