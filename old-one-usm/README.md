# ONE-USM Student Portal

A comprehensive Laravel 12.3 web application for the University of Southern Mindanao (USM) student portal system. This platform provides role-based access for students, administrators, academic records office (ARO), office of student affairs (OSA), and parents with integrated external academic systems and automated network access management.

## Table of Contents

- [Features](#features)
- [System Requirements](#system-requirements)
- [Technology Stack](#technology-stack)
- [Installation](#installation)
- [Configuration](#configuration)
- [Development](#development)
- [Deployment](#deployment)
- [Architecture](#architecture)
- [External Integrations](#external-integrations)
- [Testing](#testing)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)

## Features

### Multi-Role Access System
- **Students**: Portal access, clearance management, evaluation requests, yearbook profiles
- **Administrators**: User management, system configuration, comprehensive dashboard
- **ARO (Academic Records Office)**: Student records management, academic clearances
- **OSA (Office of Student Affairs)**: Student affairs management, clearances
- **Parents**: Access to student information and academic progress

### Core Functionality
- 🔐 **Authentication**: Email/password, Google OAuth integration
- 📡 **MikroTik Integration**: Automated campus hotspot user account creation
- 🎓 **External Academic APIs**: SAR (Student Academic Records), FPES (Faculty Performance Evaluation), CCD (Campus)
- 📋 **Clearance System**: Multi-office clearance management
- 📸 **Virtual Mapping**: Room and resource management
- 📚 **Student Yearbook**: Digital yearbook profiles
- ⚡ **Real-time UI**: Livewire components for reactive interfaces

## System Requirements

### Server Requirements
- **PHP**: ^8.3
- **Database**: SQL Server 2016+ (SQLSRV driver required)
- **Web Server**: Apache/Nginx
- **Node.js**: ^18.0 (for asset compilation)
- **Composer**: ^2.0
- **Supervisor**: For queue worker management

### PHP Extensions Required
- PDO
- SQLSRV (Microsoft SQL Server Driver for PHP)
- OpenSSL
- Mbstring
- Tokenizer
- XML
- Ctype
- JSON
- BCMath
- GD or Imagick

## Technology Stack

### Backend
- **Framework**: Laravel 12.3
- **Database**: SQL Server with SQLSRV driver
- **Queue System**: Database-driven queues
- **PDF Generation**: DOMPDF, FPDI
- **QR Codes**: Endroid QR Code
- **API Integration**: Guzzle HTTP, OpenAPI generated clients
- **Network Management**: RouterOS API (MikroTik)

### Frontend
- **CSS Framework**: TailwindCSS 3.1 with Forms plugin
- **JavaScript**: Alpine.js 3.4.2
- **Reactive Components**: Livewire 3.5
- **Build Tool**: Vite 5.0
- **DataTables**: Yajra DataTables

### Development Tools
- **Testing**: PHPUnit 11.0
- **Code Quality**: Laravel Pint
- **Debugging**: Laravel Pail (real-time log viewer)
- **API Generation**: OpenAPI Generator 7.9.0

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/nelsonbalneg/one-usm.git
cd one-usm
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. SQL Server Driver Setup

The SQL Server drivers are located in the `dll/` directory. Follow the instructions in `dll/SQLSRV_Readme.htm` to install the appropriate driver for your PHP version.

**For Windows:**
1. Copy the appropriate `.dll` file from `dll/` to your PHP `ext/` directory
2. Add the following to your `php.ini`:
   ```ini
   extension=php_sqlsrv_83_ts_x64.dll
   extension=php_pdo_sqlsrv_83_ts_x64.dll
   ```
3. Restart your web server

**For Linux:**
Follow Microsoft's documentation for installing SQL Server drivers on Linux.

### 4. Environment Configuration

```bash
# Copy the environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

Edit `.env` with your configuration (see [Configuration](#configuration) section).

### 5. Database Setup

```bash
# Run migrations
php artisan migrate

# Seed the database (optional)
php artisan db:seed
```

### 6. Build Frontend Assets

```bash
# Development
npm run dev

# Production
npm run build
```

## Configuration

### Environment Variables

#### Application Settings
```env
APP_NAME="ONE-USM Portal"
APP_ENV=production
APP_DEBUG=false
APP_TIMEZONE=Asia/Manila
APP_URL=http://172.16.0.43:1995
```

#### Database Configuration (SQL Server)
```env
DB_CONNECTION=sqlsrv
DB_HOST=172.16.0.1
DB_PORT=1433
DB_DATABASE=usmcee_stg
DB_USERNAME=your_username
DB_PASSWORD=your_password
DB_TRUST_SERVER_CERTIFICATE=true
```

#### Queue Configuration
```env
QUEUE_CONNECTION=database
```

#### MikroTik Hotspot Configuration
```env
MIKROTIK_HOST=172.16.0.11
MIKROTIK_USER=your_mikrotik_user
MIKROTIK_PASS=your_mikrotik_password
MIKROTIK_PORT=8728
MIKROTIK_SSL=true
```

#### Academic API Integration
```env
# Base Academic API
ACADEMIC_API_URL=http://172.16.0.60/academic/api/v2
ACADEMIC_FPES_API_URL=http://172.16.0.41/api/app/

# SAR (Student Academic Records)
SAR_API_URL=http://172.16.0.60/academic/api/v2/Auth/token
SAR_REDIRECT_URL=https://sar.usm.edu.ph/verify/?id=
SAR_TENANT_ID=1
SAR_CAMPUS_ID=1

# CCD (Campus)
CCD_REDIRECT_URL=https://ccd.usm.edu.ph/verify/?id=
CCD_TENANT_ID=1
CCD_CAMPUS_ID=1
```

#### Google OAuth
```env
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret
GOOGLE_REDIRECT_URI=https://one.usm.edu.ph/auth/google/callback
```

#### Mail Configuration
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=usmcee-reset-password@usm.edu.ph
MAIL_PASSWORD=your_mail_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=usmcee-reset-password@usm.edu.ph
MAIL_FROM_NAME="USM CEE"
```

## Development

### Running the Development Environment

The project includes a convenient development command that runs all necessary services concurrently:

```bash
composer dev
```

This single command starts:
1. **Laravel Development Server** (port 8000)
2. **Queue Worker** (processes background jobs)
3. **Laravel Pail** (real-time log viewer)
4. **Vite Dev Server** (hot module replacement)

### Individual Commands

```bash
# Start Laravel development server
php artisan serve

# Run queue worker
php artisan queue:work
# or with automatic restart on code changes
php artisan queue:listen --tries=1

# Watch real-time logs
php artisan pail --timeout=0

# Frontend development (hot reload)
npm run dev

# Build production assets
npm run build
```

### Working with Livewire Components

Create a new Livewire component:

```bash
php artisan make:livewire ComponentName
```

Components are located in:
- **Class**: `app/Livewire/ComponentName.php`
- **View**: `resources/views/livewire/component-name.blade.php`

Ensure `<livewire:styles />` and `<livewire:scripts />` are included in your layout file.

### Database Conventions

All models explicitly define their table names:

```php
protected $table = 'portal_users'; // Don't rely on Laravel conventions
```

Important tables:
- `portal_users` - Main authentication users
- `users` - Legacy user accounts
- `clearances` - Student clearances
- `mikrotik_requests` - Network access requests
- `virtualmap` - Room/resource mapping
- `student_yearbook` - Yearbook profiles

### Code Quality

```bash
# Format code with Laravel Pint
vendor/bin/pint

# Run tests
php artisan test
```

## Deployment

### Production Server: 172.16.0.43:1995

### 1. Server Setup

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install PHP 8.3 and required extensions
sudo apt install php8.3 php8.3-cli php8.3-fpm php8.3-xml php8.3-mbstring \
  php8.3-curl php8.3-gd php8.3-bcmath

# Install SQL Server ODBC driver (Ubuntu/Debian)
curl https://packages.microsoft.com/keys/microsoft.asc | sudo apt-key add -
curl https://packages.microsoft.com/config/ubuntu/$(lsb_release -rs)/prod.list | \
  sudo tee /etc/apt/sources.list.d/mssql-release.list
sudo apt update
sudo ACCEPT_EULA=Y apt install msodbcsql18 mssql-tools18
sudo apt install unixodbc-dev

# Install PHP SQLSRV drivers
sudo pecl install sqlsrv pdo_sqlsrv
printf "; priority=20\nextension=sqlsrv.so\n" | sudo tee /etc/php/8.3/mods-available/sqlsrv.ini
printf "; priority=30\nextension=pdo_sqlsrv.so\n" | sudo tee /etc/php/8.3/mods-available/pdo_sqlsrv.ini
sudo phpenmod -v 8.3 sqlsrv pdo_sqlsrv

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js 18+
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs

# Install Supervisor
sudo apt install supervisor
```

### 2. Deploy Application

```bash
# Clone repository
cd /var/www
sudo git clone https://github.com/nelsonbalneg/one-usm.git
cd one-usm

# Install dependencies
composer install --no-dev --optimize-autoloader
npm ci
npm run build

# Setup environment
cp .env.production .env
php artisan key:generate

# Set permissions
sudo chown -R www-data:www-data /var/www/one-usm
sudo chmod -R 755 /var/www/one-usm
sudo chmod -R 775 /var/www/one-usm/storage
sudo chmod -R 775 /var/www/one-usm/bootstrap/cache

# Run migrations
php artisan migrate --force

# Optimize application
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Configure Supervisor for Queue Workers

Create supervisor configuration file:

```bash
sudo nano /etc/supervisor/conf.d/one-usm-worker.conf
```

Add the following configuration:

```ini
[program:one-usm-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/one-usm/artisan queue:work database --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=4
redirect_stderr=true
stdout_logfile=/var/www/one-usm/storage/logs/worker.log
stopwaitsecs=3600
```

Start the supervisor processes:

```bash
# Reread supervisor configuration
sudo supervisorctl reread

# Update supervisor to add new program
sudo supervisorctl update

# Start the workers
sudo supervisorctl start one-usm-worker:*

# Check status
sudo supervisorctl status one-usm-worker:*
```

### 4. Supervisor Management Commands

```bash
# Start all workers
sudo supervisorctl start one-usm-worker:*

# Stop all workers
sudo supervisorctl stop one-usm-worker:*

# Restart all workers (after code deployment)
sudo supervisorctl restart one-usm-worker:*

# View worker status
sudo supervisorctl status

# View worker logs
tail -f /var/www/one-usm/storage/logs/worker.log
```

### 5. Web Server Configuration

#### Apache (with mod_php or PHP-FPM)

```bash
sudo nano /etc/apache2/sites-available/one-usm.conf
```

```apache
<VirtualHost *:1995>
    ServerName 172.16.0.43
    ServerAdmin admin@usm.edu.ph
    DocumentRoot /var/www/one-usm/public

    <Directory /var/www/one-usm/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/one-usm-error.log
    CustomLog ${APACHE_LOG_DIR}/one-usm-access.log combined
</VirtualHost>
```

Enable the site and configure port:

```bash
# Add Listen directive
sudo nano /etc/apache2/ports.conf
# Add: Listen 1995

# Enable site and modules
sudo a2ensite one-usm
sudo a2enmod rewrite
sudo systemctl restart apache2
```

#### Nginx (with PHP-FPM)

```bash
sudo nano /etc/nginx/sites-available/one-usm
```

```nginx
server {
    listen 1995;
    server_name 172.16.0.43;
    root /var/www/one-usm/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable the site:

```bash
sudo ln -s /etc/nginx/sites-available/one-usm /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

### 6. Deployment Updates

Create a deployment script:

```bash
sudo nano /var/www/one-usm/deploy.sh
```

```bash
#!/bin/bash

cd /var/www/one-usm

# Enable maintenance mode
php artisan down

# Pull latest changes
git pull origin develop

# Install/update dependencies
composer install --no-dev --optimize-autoloader
npm ci
npm run build

# Run migrations
php artisan migrate --force

# Clear and rebuild cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Restart queue workers
sudo supervisorctl restart one-usm-worker:*

# Disable maintenance mode
php artisan up

echo "Deployment completed successfully!"
```

Make it executable:

```bash
sudo chmod +x /var/www/one-usm/deploy.sh
```

Run deployments:

```bash
sudo /var/www/one-usm/deploy.sh
```

### 7. Monitoring and Logs

```bash
# Application logs
tail -f /var/www/one-usm/storage/logs/laravel.log

# Queue worker logs
tail -f /var/www/one-usm/storage/logs/worker.log

# Web server logs (Apache)
tail -f /var/log/apache2/one-usm-error.log

# Web server logs (Nginx)
tail -f /var/log/nginx/error.log

# Supervisor logs
sudo tail -f /var/log/supervisor/supervisord.log
```

## Architecture

### Multi-Role Route System

Routes are segregated by user role in separate files:

```
routes/
├── web.php      # Public routes and auth
├── admin.php    # Admin dashboard (prefix: /admin)
├── student.php  # Student portal (prefix: /student)
├── aro.php      # Academic Records Office (prefix: /aro)
├── osa.php      # Office of Student Affairs (prefix: /osa)
├── parent.php   # Parent portal (prefix: /parent)
├── auth.php     # Authentication routes
└── console.php  # Artisan commands
```

Route registration in `bootstrap/app.php`:

```php
Route::middleware(['web', 'auth', 'role:admin', 'update.last.seen'])
    ->prefix('admin')
    ->as('admin.')
    ->group(base_path('routes/admin.php'));
```

### Middleware Stack

Custom middleware aliases configured in `bootstrap/app.php`:

- **`role:{role}`**: Role-based access control (checks `User::hasRole()`)
- **`update.last.seen`**: Tracks user activity in `last_seen` column
- **`check.maintenance`**: Custom maintenance mode checks
- **`csrf.except.api`**: CSRF exemption for API routes

### User Authentication

**Critical**: Two user models exist:
- **`App\Models\User`** (table: `portal_users`) - **Primary authentication model**
- **`App\Models\UserAccount`** (table: `users`) - Legacy/alternate system

Always use the `User` model for authentication and authorization.

### Database Models

All models explicitly define table names:

```php
// app/Models/User.php
protected $table = 'portal_users';

// app/Models/Clearance.php
protected $table = 'clearances';

// app/Models/MikroTikRequest.php
protected $table = 'mikrotik_requests';
```

This prevents reliance on Laravel's table naming conventions.

## External Integrations

### 1. MikroTik Hotspot Integration

**Purpose**: Automate campus network access by creating hotspot user accounts.

**Service**: `app/Services/MikroTikService.php`
- Uses `evilfreelancer/routeros-api-php` package
- Connects to MikroTik router API (port 8728)
- Standard profile: `U-Students`, server: `hotspot2`

**Job Pattern**: `app/Jobs/CreateMikroTikAccount.php`
- Implements `ShouldQueue` for asynchronous processing
- Creates MikroTik user and database record atomically
- Handles network timeouts gracefully

Example usage:
```php
use App\Jobs\CreateMikroTikAccount;

CreateMikroTikAccount::dispatch($studentNo, $password, $semester);
```

### 2. Academic System APIs

**Configuration**: `config/academic.php`

#### FPES (Faculty Performance Evaluation System)
- Base URL: `http://172.16.0.41/api/app/`
- Used for faculty evaluation data

#### SAR (Student Academic Records)
- API URL: `http://172.16.0.60/academic/api/v2/Auth/token`
- Redirect URL: `https://sar.usm.edu.ph/verify/?id=`
- Handles student academic record verification

#### CCD (Campus Data)
- Redirect URL: `https://ccd.usm.edu.ph/verify/?id=`
- Campus-specific academic data

**Service Pattern**: See `app/Services/SarService.php`
```php
public function generateToken(string $studentNo, int $campusId, int $tenantId): ?string
{
    $url = "{$this->apiUrl}/{$studentNo}/{$campusId}?tenantId={$tenantId}";
    $response = Http::post($url);
    return $response->ok() ? trim($response->body()) : null;
}
```

### 3. OpenAPI Generated Clients

The `proxies/` directory contains auto-generated API clients:

- Generated using OpenAPI Generator 7.9.0 (config: `openapitools.json`)
- Namespace: `OpenAPI\Client\` (autoloaded in `composer.json`)
- Located in `lib/` directory

**Best Practice**: Always wrap generated clients in service classes:

```php
// app/Services/ApiProgramPoliciesService.php
use OpenAPI\Client\Api\ProgramPoliciesApi;
use OpenAPI\Client\ApiException;

class ApiProgramPoliciesService
{
    protected $client;

    public function __construct()
    {
        $this->client = new ProgramPoliciesApi();
    }

    public function getProgramPolicies($termId, $realCampusId)
    {
        try {
            return $this->client->apiV2ProgramPoliciesListTermTermIdRealcampusRealCampusIdGet(
                $termId, 
                $realCampusId
            );
        } catch (ApiException $e) {
            throw new \Exception("API Request failed: " . $e->getMessage());
        }
    }
}
```

### 4. Google OAuth Integration

Configuration in `.env`:
```env
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret
GOOGLE_REDIRECT_URI=https://one.usm.edu.ph/auth/google/callback
```

Routes:
- Login: `GET /auth/google`
- Callback: `GET /auth/google/callback`

Controller: `app/Http/Controllers/Auth/GoogleController.php`

### 5. Image Upload System

**Trait**: `app/Trait/ImageUploadTrait.php`

Provides standardized image handling:

```php
use App\Trait\ImageUploadTrait;

class YourController extends Controller
{
    use ImageUploadTrait;

    public function store(Request $request)
    {
        // Single image upload
        $imagePath = $this->uploadImage($request, 'photo', 'uploads/photos');

        // Multiple images
        $imagePaths = $this->uploadMultiImage($request, 'photos', 'uploads/gallery');

        // Update existing image
        $newPath = $this->updateImage($request, 'photo', 'uploads/photos', $oldPath);
    }
}
```

Images are stored in `public/` with naming: `media_{uniqid()}.{ext}`

## Testing

### Running Tests

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/UserTest.php

# Run with coverage
php artisan test --coverage

# Using PHPUnit directly
vendor/bin/phpunit
```

### Test Structure

```
tests/
├── Feature/       # Feature tests (HTTP, database)
├── Unit/          # Unit tests (isolated logic)
└── TestCase.php   # Base test case
```

## Troubleshooting

### SQL Server Connection Issues

**Error**: `SQLSTATE[08001] Unable to connect`

**Solutions**:
1. Verify SQL Server is running and accessible
2. Check firewall rules (port 1433)
3. Ensure `DB_TRUST_SERVER_CERTIFICATE=true` in `.env`
4. Test connection:
   ```bash
   php artisan tinker
   DB::connection()->getPdo();
   ```

### Queue Workers Not Processing

**Symptoms**: Jobs stay in queue, not executed

**Solutions**:
1. Check supervisor status:
   ```bash
   sudo supervisorctl status one-usm-worker:*
   ```

2. Restart workers:
   ```bash
   sudo supervisorctl restart one-usm-worker:*
   ```

3. Check worker logs:
   ```bash
   tail -f storage/logs/worker.log
   ```

4. Manually process queue:
   ```bash
   php artisan queue:work --once
   ```

### MikroTik Connection Failures

**Error**: `Unable to connect to MikroTik router`

**Solutions**:
1. Verify MikroTik API is enabled
2. Check credentials in `.env`
3. Test network connectivity: `ping 172.16.0.11`
4. Verify port 8728 is open
5. Check MikroTik API user permissions

### Asset Compilation Issues

**Error**: `Vite manifest not found`

**Solutions**:
1. Build assets:
   ```bash
   npm run build
   ```

2. For development:
   ```bash
   npm run dev
   ```

3. Clear compiled views:
   ```bash
   php artisan view:clear
   ```

### Permission Issues

**Error**: `The stream or file could not be opened`

**Solutions**:
```bash
# Set correct ownership
sudo chown -R www-data:www-data storage bootstrap/cache

# Set correct permissions
sudo chmod -R 775 storage bootstrap/cache

# Recreate directories if needed
php artisan storage:link
```

### Cache Issues After Deployment

Clear all caches:
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Then rebuild
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Contributing

### Development Workflow

1. **Create a feature branch**:
   ```bash
   git checkout -b feature/your-feature-name
   ```

2. **Make changes and test**:
   ```bash
   composer dev  # Run all services
   php artisan test
   ```

3. **Format code**:
   ```bash
   vendor/bin/pint
   ```

4. **Commit changes**:
   ```bash
   git add .
   git commit -m "Description of changes"
   ```

5. **Push and create pull request**:
   ```bash
   git push origin feature/your-feature-name
   ```

### Code Standards

- Follow PSR-12 coding standards
- Use Laravel Pint for formatting
- Write tests for new features
- Document complex logic
- Use meaningful variable/method names

### Adding New Role-Based Routes

1. Create or edit role route file: `routes/{role}.php`
2. Add route registration in `bootstrap/app.php`:
   ```php
   Route::middleware(['web', 'auth', 'role:newrole', 'update.last.seen'])
       ->prefix('newrole')
       ->as('newrole.')
       ->group(base_path('routes/newrole.php'));
   ```
3. Create controller: `app/Http/Controllers/Role/{RoleName}Controller.php`

### Adding External API Integration

1. Add configuration to `config/academic.php`
2. Create service class in `app/Services/`
3. Inject config via constructor
4. Wrap API calls in try-catch
5. Create queued jobs for time-intensive operations

## License

This project is proprietary software developed for the University of Southern Mindanao (USM). All rights reserved.

## Support

For technical support or questions:
- **Repository**: https://github.com/nelsonbalneg/one-usm
- **Documentation**: See `.github/copilot-instructions.md`
- **Issues**: Create an issue on GitHub

---

**Production Deployment**: http://172.16.0.43:1995  
**Development Server**: http://127.0.0.1:8000  
**Version**: Laravel 12.3  
**Last Updated**: December 2025
