# Rethink - Laravel Livewire Starter Kit

A modern Laravel 12 application built with Livewire and Flux UI components, featuring a component-based architecture with reactive user interfaces and comprehensive authentication system.

## 🚀 Tech Stack

- **Framework**: Laravel 12.23.1
- **Frontend**: Livewire 3.6.4 with Volt 1.7.2 
- **UI Components**: Flux UI Free 2.2.4
- **Styling**: Tailwind CSS 4.0.7
- **Build Tool**: Vite 7.0.4
- **Testing**: Pest 3.8.2
- **Code Style**: Laravel Pint 1.24.0
- **Database**: SQLite (development) / MySQL (production)
- **Permissions**: Spatie Laravel Permission 6.21

## ✨ Features

### Authentication System
- User registration and login
- Email verification 
- Password reset functionality
- Password confirmation for sensitive actions
- Session management and logout

### User Management
- User profile management
- Password updates
- Account appearance settings
- Account deletion
- Administrator user management panel

### Architecture Highlights
- **Livewire Components**: Server-side reactive components
- **Volt Integration**: Single-file component support
- **Flux UI**: Modern component library with consistent design
- **Role-based Permissions**: Powered by Spatie Laravel Permission
- **Clean Code**: Laravel Pint enforced code styling

## 🛠️ Installation

### Prerequisites
- PHP 8.2 or higher
- Node.js (for frontend assets)
- Composer
- SQLite or MySQL

### Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd rethink
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   # For SQLite (default)
   touch database/database.sqlite
   php artisan migrate --seed
   
   # For MySQL - configure your .env file first, then:
   # php artisan migrate --seed
   ```

## 🚀 Development

### Development Server
Start the development environment with hot reloading:

```bash
# All-in-one development command (recommended)
composer dev

# Or run services separately:
php artisan serve    # Laravel server
npm run dev         # Vite development server
php artisan queue:listen  # Queue worker
```

The application will be available at `http://localhost:8000` or through Laravel Herd at `https://rethink.test`

### Available Commands

#### PHP/Laravel
```bash
composer dev          # Start full development environment
composer test         # Run test suite with config cleanup
php artisan serve     # Laravel development server
php artisan test      # Run tests via Artisan
./vendor/bin/pest     # Run Pest tests directly
vendor/bin/pint       # Code formatting
```

#### Frontend
```bash
npm run dev          # Vite development server
npm run build        # Production build
```

#### Testing
```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/ExampleTest.php

# Run tests with filter
php artisan test --filter=testName
```

## 📁 Project Structure

```
app/
├── Http/Controllers/     # Minimal controllers (mainly auth)
├── Livewire/            # Livewire components
│   ├── Actions/         # Action components (Logout, etc.)
│   ├── Auth/            # Authentication components
│   ├── Settings/        # User settings components
│   └── Administrator/   # Admin panel components
├── Models/              # Eloquent models
└── Providers/           # Service providers

resources/
├── views/
│   ├── components/      # Blade components
│   ├── layouts/         # Application layouts
│   ├── livewire/        # Livewire component templates
│   └── flux/            # Custom Flux components
└── js/                  # Frontend JavaScript

routes/
├── web.php             # Web routes
├── auth.php            # Authentication routes
└── console.php         # Console routes

tests/
├── Feature/            # Feature tests
└── Unit/               # Unit tests
```

## 🧪 Testing

The project uses Pest for testing with comprehensive coverage:

- **Feature Tests**: End-to-end functionality testing
- **Unit Tests**: Individual component testing  
- **Livewire Tests**: Component interaction testing
- **Authentication Tests**: Security and auth flow testing

### Running Tests
```bash
# Full test suite
composer test

# Specific tests
php artisan test tests/Feature/Auth/LoginTest.php
php artisan test --filter="user can login"
```

## 🎨 UI Components

### Flux UI Components
Available free Flux UI components:
- `avatar`, `badge`, `brand`, `breadcrumbs`, `button`
- `callout`, `checkbox`, `dropdown`, `field`, `heading`
- `icon`, `input`, `modal`, `navbar`, `profile`
- `radio`, `select`, `separator`, `switch`, `text`
- `textarea`, `tooltip`

### Livewire Patterns
```php
// Component with reactive state
use function Livewire\Volt\{state};

state(['count' => 0]);
$increment = fn() => $this->count++;
```

```blade
{{-- Real-time updates --}}
<flux:input wire:model.live="search" placeholder="Search..." />

{{-- Loading states --}}
<flux:button wire:click="save" wire:loading.attr="disabled">
    <span wire:loading.remove>Save</span>
    <span wire:loading>Saving...</span>
</flux:button>
```

## 🔒 Security

- **Authentication**: Laravel's built-in auth system
- **Authorization**: Role and permission-based access control
- **CSRF Protection**: Enabled by default
- **XSS Prevention**: Blade template escaping
- **SQL Injection Prevention**: Eloquent ORM and query builder

## 📊 Available Routes

### Public Routes
- `/` - Homepage
- `/login` - User login
- `/register` - User registration
- `/forgot-password` - Password reset request
- `/reset-password/{token}` - Password reset form

### Authenticated Routes  
- `/dashboard` - User dashboard
- `/settings/profile` - Profile management
- `/settings/password` - Password updates
- `/settings/appearance` - UI preferences
- `/verify-email` - Email verification

### Admin Routes
- `/administrator/users` - User management (admin only)

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/amazing-feature`
3. Make your changes following the existing code style
4. Run tests: `composer test`
5. Format code: `vendor/bin/pint`
6. Commit changes: `git commit -m 'Add amazing feature'`
7. Push to branch: `git push origin feature/amazing-feature`
8. Open a Pull Request

### Code Style
- Follow PSR-12 coding standards
- Use Laravel Pint for automatic formatting
- Write descriptive commit messages
- Include tests for new features

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

- **Documentation**: Check `CLAUDE.md` for development guidelines
- **Issues**: Create an issue for bugs or feature requests
- **Laravel**: Visit [Laravel Documentation](https://laravel.com/docs)
- **Livewire**: Visit [Livewire Documentation](https://livewire.laravel.com)

## 🙏 Acknowledgments

- Built on [Laravel Framework](https://laravel.com)
- UI powered by [Livewire](https://livewire.laravel.com) and [Flux UI](https://fluxui.dev)
- Testing with [Pest](https://pestphp.com)
- Styling with [Tailwind CSS](https://tailwindcss.com)