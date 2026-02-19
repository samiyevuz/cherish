# ============================================================
# CherishStyle — Setup Script
# Run this script AFTER:
#   1. Starting MySQL-8.0 in OSPanel (or any MySQL/MariaDB)
#   2. Node.js is auto-installed if not found
# ============================================================
# NOTE: MySQL must be running on 127.0.1.27:3306 (OSPanel default)
# The script will auto-create the 'cherishstyle' database.
# ============================================================

$php  = "C:\OSPanel\modules\PHP-8.2\php.exe"
$mysql = "C:\OSPanel\modules\MySQL-8.0\bin\mysql.exe"
$root = "C:\OSPanel\home\cherishstyle\public"

Set-Location $root

Write-Host "`n=== CherishStyle Setup ===" -ForegroundColor Cyan

# 0. Create database and user
Write-Host "`n[0/7] Creating database and user..." -ForegroundColor Yellow
if (Test-Path $mysql) {
    & $mysql -h 127.0.1.27 -P 3306 -u root -e "CREATE DATABASE IF NOT EXISTS cherishstyle CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
    & $mysql -h 127.0.1.27 -P 3306 -u root -e "CREATE USER IF NOT EXISTS 'cherishstyle'@'%' IDENTIFIED BY 'dJ0iI5bI8z';"
    & $mysql -h 127.0.1.27 -P 3306 -u root -e "CREATE USER IF NOT EXISTS 'cherishstyle'@'localhost' IDENTIFIED BY 'dJ0iI5bI8z';"
    & $mysql -h 127.0.1.27 -P 3306 -u root -e "GRANT ALL PRIVILEGES ON cherishstyle.* TO 'cherishstyle'@'%';"
    & $mysql -h 127.0.1.27 -P 3306 -u root -e "GRANT ALL PRIVILEGES ON cherishstyle.* TO 'cherishstyle'@'localhost';"
    & $mysql -h 127.0.1.27 -P 3306 -u root -e "FLUSH PRIVILEGES;"
    Write-Host "  Database and user created." -ForegroundColor Green
}

# 1. Generate app key if not set
Write-Host "`n[1/7] Checking APP_KEY..." -ForegroundColor Yellow
& $php artisan key:generate --ansi --force

# 2. Run database migrations
Write-Host "`n[2/7] Running migrations..." -ForegroundColor Yellow
& $php artisan migrate --force

# 3. Seed database
Write-Host "`n[3/7] Seeding database..." -ForegroundColor Yellow
& $php artisan db:seed --force

# 4. Create storage symlink
Write-Host "`n[4/7] Creating storage symlink..." -ForegroundColor Yellow
& $php artisan storage:link

# 5. Clear caches
Write-Host "`n[5/7] Clearing caches..." -ForegroundColor Yellow
& $php artisan config:clear
& $php artisan cache:clear
& $php artisan view:clear
& $php artisan route:clear

# 6. Install npm packages (requires Node.js)
Write-Host "`n[6/7] Installing npm packages..." -ForegroundColor Yellow
if (Get-Command npm -ErrorAction SilentlyContinue) {
    npm install
    Write-Host "`n[7/7] Building assets..." -ForegroundColor Yellow
    npm run build
} else {
    Write-Host "  [!] npm not found. Install Node.js from https://nodejs.org" -ForegroundColor Red
    Write-Host "      After installing, run: npm install && npm run build" -ForegroundColor Red
}

Write-Host "`n=== Setup Complete! ===" -ForegroundColor Green
Write-Host ""
Write-Host "Admin Login:" -ForegroundColor Cyan
Write-Host "  Email:    admin@cherishstyle.uz" -ForegroundColor White
Write-Host "  Password: password" -ForegroundColor White
Write-Host ""
Write-Host "Demo User:" -ForegroundColor Cyan
Write-Host "  Email:    demo@cherishstyle.uz" -ForegroundColor White
Write-Host "  Password: password" -ForegroundColor White
Write-Host ""
Write-Host "Admin Panel: http://cherishstyle.local/admin" -ForegroundColor Cyan
Write-Host ""
