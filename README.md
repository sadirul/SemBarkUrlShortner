# SemBark URL Shortener

SemBark URL Shortener is a Laravel-based application for generating short URLs with role-based user management and analytics.

## Installation

### 1. Clone Repository
```bash
git clone https://github.com/sadirul/SemBarkUrlShortner.git
cd SemBarkUrlShortner
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup Environment
```bash
cp .env.example .env
```

Update MySQL settings in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Run Migration
```bash
php artisan migrate
```

### 5. Seed SuperAdmin
```bash
php artisan db:seed --class=SuperAdminSeeder
```

### Default SuperAdmin Login
- **Email:** superadmin@example.com  
- **Password:** 1234567890

### 6. Start Server
```bash
php artisan serve
```

App URL:
```
http://127.0.0.1:8000
```

LIVE URL:
```
https://url.sadirul.in

Email: superadmin@example.com
Password: 1234567890
```

## Features
- URL shortening  
- Click analytics  
- User management  
- Role permissions  
- SuperAdmin panel  

## Contributing
Pull requests and suggestions are welcome.

## Author
**Sadirul Islam**  
GitHub: https://github.com/sadirul
