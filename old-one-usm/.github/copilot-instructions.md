# ONE-USM Project - AI Coding Agent Instructions

## Project Overview
This is a Laravel 12.3 application for University of Southern Mindanao (USM) student portal with role-based access, MikroTik integration, and external academic API connections. The system uses SQL Server as the primary database and integrates with multiple external systems (SAR, FPES, CCD).

## Architecture & Key Components

### Multi-Role Route Structure
Routes are segregated by user role with dedicated route files and middleware:
- `routes/admin.php` - Admin dashboard and management
- `routes/student.php` - Student portal features
- `routes/aro.php` - Academic Records Office
- `routes/osa.php` - Office of Student Affairs
- `routes/parent.php` - Parent access portal
- `routes/web.php` - Public and authentication routes

**Route registration pattern** (see `bootstrap/app.php`):
```php
Route::middleware(['web', 'auth', 'role:admin', 'update.last.seen'])
    ->prefix('admin')
    ->as('admin.')
    ->group(base_path('routes/admin.php'));
```

Role enforcement uses `RoleMiddleware` checking `User::hasRole($role)` method. All authenticated routes require the `role:` middleware alias.

### Database Configuration
**Primary Database**: SQL Server (sqlsrv driver)
- Connection details in `config/database.php` lines 100-113
- Custom table names via `protected $table` property in models:
  - `User` → `portal_users`
  - `UserAccount` → `users`
  - `Clearance` → `clearances`
  - `MikroTikRequest` → `mikrotik_requests`
  - `VirtualMap` → `virtualmap`
  - `StudentYearBook` → `student_yearbook`

SQL Server drivers located in `dll/` directory with configuration notes.

### External System Integrations

#### 1. Academic APIs (config/academic.php)
- **FPES API**: Faculty Performance Evaluation System at `http://172.16.0.41/api/app/`
- **SAR API**: Student Academic Records system
- **CCD API**: Campus-specific academic data
- Each system has dedicated `{system}_api_url`, `{system}_redirect_url`, `{system}_tenant_id`, `{system}_campus_id` config keys

**Service Pattern**: See `app/Services/SarService.php` for token generation and API communication patterns. All external API services inject configuration via constructor.

#### 2. MikroTik Hotspot Integration
**Purpose**: Automated hotspot user account creation for campus network access.

**Service**: `app/Services/MikroTikService.php`
- Uses `evilfreelancer/routeros-api-php` package
- Configuration via env vars: `MIKROTIK_HOST`, `MIKROTIK_USER`, `MIKROTIK_PASS`
- Standard profile: `U-Students`, server: `hotspot2`

**Job Pattern**: `app/Jobs/CreateMikroTikAccount.php`
- Queued job implementing `ShouldQueue`
- Creates MikroTik user + database record atomically
- Always use jobs for MikroTik operations to handle API timeouts

#### 3. OpenAPI Generated Clients
The `proxies/` directory contains auto-generated API clients from OpenAPI specs:
- Generated using `openapitools.json` config (OpenAPI Generator v7.9.0)
- Namespace: `OpenAPI\Client\` (autoloaded via `composer.json` - `"OpenAPI\\Client\\": "lib/"`)
- Example usage: `app/Services/ApiProgramPoliciesService.php` wraps `OpenAPI\Client\Api\ProgramPoliciesApi`

**Pattern**: Always wrap generated clients in service classes under `app/Services/` for easier testing and error handling.

### Livewire Components
Livewire 3.5 is used for reactive UI components:
- Components in `app/Livewire/` (e.g., `RoomSelection.php`, `TestComponent.php`)
- Styles/scripts included in `resources/views/{role}/layouts/master.blade.php`
- Standard pattern: public properties for reactive state, `updated{Property}` hooks for side effects

### Middleware & Security
Custom middleware aliases (see `bootstrap/app.php`):
- `role:{role}` - Role-based access control (RoleMiddleware)
- `check.maintenance` - Maintenance mode check (CheckMaintenanceMode)
- `update.last.seen` - Track user activity (UpdateLastSeen)
- `csrf.except.api` - CSRF exemption for API routes (ExcludeApiRoutesFromCsrf)

All authenticated routes must include `update.last.seen` middleware to track the `last_seen` column in `portal_users`.

### Image Handling
**Trait**: `app/Trait/ImageUploadTrait.php` provides standard image upload methods:
- `uploadImage()` - Single file upload to public path
- `uploadMultiImage()` - Multiple file uploads
- `updateImage()` - Replace existing file with cleanup

Images stored in `public/` with naming pattern: `media_{uniqid()}.{ext}`

## Development Workflow

### Running the Application
**Production-ready dev command** (defined in `composer.json`):
```bash
composer dev
```
This runs concurrently:
1. `php artisan serve` - Laravel dev server
2. `php artisan queue:listen --tries=1` - Queue worker
3. `php artisan pail --timeout=0` - Real-time log viewer
4. `npm run dev` - Vite dev server (hot reload)

**Individual commands**:
```bash
php artisan serve          # Web server only
php artisan queue:work     # Process queued jobs
npm run dev                # Frontend dev build
npm run build              # Production build
```

### Database & Migrations
SQL Server connection requires specific environment variables:
```
DB_CONNECTION=sqlsrv
DB_HOST=172.16.0.1
DB_PORT=1433
DB_DATABASE=usmcee
DB_USERNAME=butch
DB_PASSWORD=B2:-Ec28L$(?
DB_ENCRYPT=no
DB_TRUST_SERVER_CERTIFICATE=true
```

Migration naming shows evolution: recent migrations (2025_*) add features to existing `portal_users` table rather than creating new user tables.

### Testing
- PHPUnit configured in `phpunit.xml`
- Test namespace: `Tests\` in `tests/` directory
- Run via: `php artisan test` or `vendor/bin/phpunit`

## Project-Specific Conventions

### User Model Duality
**Critical**: Two user models exist:
- `App\Models\User` - Authentication (table: `portal_users`) - **Primary for auth**
- `App\Models\UserAccount` - Legacy/alternate (table: `users`)

Always use `User` model for authentication. Check `app/Models/User.php` for the `hasRole()` method implementation.

### API Client Pattern
When adding new external APIs:
1. Place OpenAPI specs in `proxies/` if auto-generating clients
2. Generate client code to `lib/` directory (autoloaded namespace)
3. Create wrapper service in `app/Services/` with:
   - Config injection in constructor
   - Exception handling wrapping `ApiException`
   - Method names matching business domain (not API endpoints)

### Queue Usage
Use queues for:
- MikroTik operations (network latency)
- External API calls (SAR, FPES, CCD)
- PDF generation (DOMPDF, FPDI packages installed)
- Bulk operations

Job location: `app/Jobs/`, always implement `ShouldQueue` interface.

### Frontend Stack
- **CSS Framework**: TailwindCSS 3.1 with `@tailwindcss/forms`
- **JS Framework**: Alpine.js 3.4.2 (imported in resources)
- **Build Tool**: Vite 5.0 with Laravel plugin
- **Content Paths**: `resources/views/**/*.blade.php`, `storage/framework/views/*.php`

### Environment Files
Three environment configurations exist:
- `.env` - Local development
- `.env.production` - Production settings
- `.env.example` - Template for new installations

Both `.env` and `.env.production` use `sqlsrv` connection; example shows `mysql`.

## Common Tasks

### Adding a New Role-Based Route
1. Create/edit role route file in `routes/{role}.php`
2. Add route registration in `bootstrap/app.php` following existing pattern
3. Create controller in `app/Http/Controllers/Role/{RoleName}Controller.php`
4. Ensure `role:{rolename}` middleware applied at route group level

### Creating External API Integration
1. Add config entries to `config/academic.php` or create new config file
2. Create service class in `app/Services/` extending base pattern
3. Inject configuration via constructor using `config()` helper
4. Wrap API calls in try-catch handling service-specific exceptions
5. Consider creating queued jobs for time-intensive operations

### Adding Livewire Component
1. Create component: `php artisan make:livewire ComponentName`
2. Component class goes to `app/Livewire/`, view to `resources/views/livewire/`
3. Use in blade: `<livewire:component-name />` or `@livewire('component-name')`
4. Ensure `<livewire:styles />` and `<livewire:scripts />` in layout master file

### Database Model Creation
1. Use migration naming: `YYYY_MM_DD_HHMMSS_descriptive_name.php`
2. Set `protected $table` explicitly (don't rely on Laravel naming conventions)
3. Include model in `app/Models/` with proper fillable/casts
4. For SQL Server specifics, check existing migrations in `database/migrations/`
